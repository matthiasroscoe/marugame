<?php 
    if ($m['feed_type'] == 'short') {
        include('news-events/short.php');
    } else {
        include('news-events/full.php');
    }
?>