<?php 
add_action('wp_ajax_nopriv_submit_contact_form', 'submit_contact_form');
add_action('wp_ajax_submit_contact_form', 'submit_contact_form');

function submit_contact_form() {
    $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : null;
    $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : null;
    $enquiry_type = (isset($_POST['enquiry_type'])) ? $_POST['enquiry_type'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $message = (isset($_POST['message'])) ? $_POST['message'] : null;

    /**
     * Create new enquiry post post in CMS
     */

    $enquiry_post = wp_insert_post(array(
        'post_type' => 'enquiry',
        'post_status' => 'publish',
        'post_title' => $first_name . ' ' . $last_name . ' / ' . $email,
        'post_name' => $first_name . '-' . $last_name,
    ));
    
    if ($enquiry_post) {
        update_field('first_name', $first_name, $enquiry_post);
        update_field('last_name', $last_name, $enquiry_post);
        update_field('enquiry_type', $enquiry_type, $enquiry_post);
        update_field('message', $message, $enquiry_post);
        update_field('email', $email, $enquiry_post);
        $post_created = true;
    } else {
        $post_created = false;
    }

    /**
     * Send email notification
     */
    if ($enquiry_type == 'Press Enquiry') {
        $to = 'marugameUdon@wcommunications.co.uk';
    } else if ($enquiry_type == 'Recruitment & Careers') {
        $to = 'recruitment@marugame.co.uk';
    } else {
        $to = 'konnichiwa@marugame.co.uk';
    }

    $subject = 'Marugame Website - New contact form submission';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: noreply@marugame.co.uk'
    );

    ob_start();
    ?>
        <p>You have received a new submission from the contact form. The details are as follows:</p>
        <p>Name: <?php echo $first_name . ' ' . $last_name; ?></p>
        <p>Email address: <?php echo $email; ?></p>
        <p>Enquiry Type: <?php echo $enquiry_type; ?></p>
        <p>Message: <?php echo $message; ?></p>
    <?php
    $email_body = ob_get_clean();
    
    $send = wp_mail($to, $subject, $email_body, $headers);
    if ($send && $post_created) {
        echo 'success';
    } else if ($send && ! $post_created) {
        echo 'post creation fail';
    } else {
        echo 'fail';
    }

    wp_die();
}
?>