<?
/*
Plugin Name: teaser slider
Plugin URI: http://wordpress.org/extend/plugins/teaser-slider/
Description: show an ajax sliding carosel of random posts
Version: 1.0
Author: fris
Author URI: http://wordpress.org
*/

function slider_init() {
	$sheet = get_option('home') . '/wp-content/plugins/slider/scripts/slider.css';
	$slide = get_option('home') . '/wp-content/plugins/slider/scripts/scrollable.js';
	echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="'.$slide.'"></script>';
	echo '<link rel="stylesheet" type="text/css" href="'.$sheet.'" />'; 
}

function teaserslider($amount=8) {
     global $post;
     echo '<div id="scrollable"><a class="prev"></a><div class="items">';
     $slide = new WP_Query("showposts=".$amount."&orderby=rand");
     while($slide->have_posts()) : $slide->the_post();
     $att = get_posts(array('post_type' => 'attachment','numberposts' => -1,'post_status' => null,'post_parent' => $post->ID)); 
     if ($att) {
       $link = get_permalink($post->ID);
       $image = wp_get_attachment_url($att[0]->ID); 
       echo '<a href="'.$link.'"><img src="'.$image.'" width="86" height="66" border="0" alt="" />';
     }
     endwhile;
     echo '</div><a class="next"></a></div><script>$("#scrollable").scrollable();</script>';
}

add_action('wp_head', 'slider_init');

?>
