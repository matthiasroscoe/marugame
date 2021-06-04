<?php 
/**
 * News / Events helper functions
 */

/**
 * Get thumbnail image for a post.
 * If no image, fallback to required hero_image field 
 */
function get_thumbnail_image($id = null) {
    if ($id == null) {
        return;
    }

    $img = '';
    if (get_field('thumbnail', $id)) {
        $img = get_field('thumbnail', $id);
    } else {
        $img = get_field('hero_image', $id);
    }

    return $img;
}


/**
 * Get full news/events feed
 */

add_action('wp_ajax_get_news_events_feed', 'get_news_events_feed');
add_action('wp_ajax_nopriv_get_news_events_feed', 'get_news_events_feed');

function get_news_events_feed() {
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : 'post';
    $posts_per_page = (isset($_POST['posts_per_page'])) ? $_POST['posts_per_page'] : '10';
    
    // Get latest 10 posts
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
        'fields' => 'ids'
    );
    $posts = get_posts($args);

    // Get latest 2 featured posts
    $featured_posts = get_featured_posts($post_type);
    
    // Remove any featured posts from the latest 10 posts to avoid duplication
    $filtered_posts = $featured_posts;
    $num_posts = count($featured_posts);
    foreach($posts as $post) {
        if ($num_posts > $posts_per_page) {
            break;
        } else {
            if (! in_array($post, $featured_posts)) {
                $filtered_posts[] = $post;
            }
        }
        
        $num_posts++;
    }

    // If two featured posts are available, 
    // move the second feat post to be the 6th item in array
    if (count($featured_posts) >= 2 && count($filtered_posts) >= 6) {
        $second_featured_post = array_splice($filtered_posts, 1, 1);
        array_splice($filtered_posts, 6, 0, $second_featured_post);
    }

    // Loop through all posts and get html
    $html = '';
    if (! empty($filtered_posts)) {
        $html .= get_article_card($filtered_posts[0], 'featured');
        
        for ($i=1; $i < 6; $i++) { 
            if (isset($filtered_posts[$i])) {
                $html .= get_article_card($filtered_posts[$i]);
            }
        }

        if (isset($filtered_posts[6])) {
            $html .= get_article_card($filtered_posts[6], 'featured');
        }

        for ($i=7; $i < 10; $i++) { 
            if (isset($filtered_posts[$i])) {
                $html .= get_article_card($filtered_posts[$i]);
            }
        }
    }

    if ($html == '') {
        echo '<div class="col-auto"><h3 class="t-subheading t-black">No articles could be found</h3></div>';
    } else {
        echo $html;
    }

    wp_die();
}

/**
 * Get featured articles/events
 */

function get_featured_posts($post_type = 'post') {
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => 2,
        'post_status' => 'publish',
        'fields' => 'ids',
        'meta_key' => 'featured_post',
        'meta_value' => true,
    );
    $posts = get_posts($args);

    if ($posts) {
        return $posts;
    } else {
        return array();
    }

    return $posts;
}


/**
 * Get article card
 */

function get_article_card($post_id, $card_type = 'normal') {
    if ($post_id == null) {
        return;
    }

    $img = get_thumbnail_image($post_id);
    ob_start();
    ?>
        <div class="news-events-full__article news-events-full__article--<?php echo $class = ($card_type == 'featured') ? 'featured' : 'normal'; ?> js-thumb-hover">
            <img class="news-events-full__article__img js-thumb-img" src="<?php echo $img['sizes']['large']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
            <div class="news-events-full__article__content">
                <h2 class="<?php echo $class = ($card_type == 'featured') ? 't-thumb-heading' : ''; ?>"><?php echo get_the_title($post_id); ?></h2>
                <p class="description <?php echo $class = ($card_type == 'featured') ? '' : 'd-none d-lg-block'; ?>"><?php echo get_field('description', $post_id); ?></p>
                <?php 
                    $btn_data = array(
                        'url' => get_the_permalink($post_id),
                        'title' => __('Read More'),
                        'target' => '_self',
                    );
                    echo get_button($btn_data, 'd-lg-none mt-1 mt-lg-3');
                ?>
                <img class="arrow d-none d-lg-block" src="<?php echo get_icon('thumbnail-arrow.svg'); ?>" alt="View Article">
            </div>
            <a class="news-events-full__article__link d-none d-lg-block u-fluid" href="<?php the_permalink($post_id); ?>"></a>
        </div>
    <?php
    return ob_get_clean();
}


?>