<?php

add_theme_support( 'post-thumbnails' ); 

// Clean wp_head
remove_action(	'wp_head',			'rsd_link' );
remove_action(	'wp_head',			'wlwmanifest_link' );
remove_action(	'wp_head',			'index_rel_link' );
remove_action(	'wp_head',			'wp_generator' );
remove_action(	'wp_head',			'start_post_rel_link' );
remove_action(	'wp_head',			'adjacent_posts_rel_link' );
remove_action(	'wp_head',			'wp_shortlink_wp_head' );
remove_action(	'wp_head',			'print_emoji_detection_script', 7 );
remove_action(	'wp_head',			'rest_output_link_wp_head', 10 );
remove_action(	'wp_head',			'wp_oembed_add_discovery_links', 10 );
remove_action(	'wp_print_styles',	'print_emoji_styles' ); 

// Enable comment-reply.js 
function xtreme_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'xtreme_enqueue_comments_reply' );



// Get posts by category
function getPostsByCat( $category ) {
	$posts = array();

	$args = array(
		'category_name'		=> $category,
//		'meta_key'			=> 'menu_order',
//		'orderby'			=> 'meta_value_num',
    'order'				=> 'asc',	
		'post_type'			=> 'post',
		'post_status'		=> 'publish'
	);
	$posts_query = get_posts( $args );

	foreach ( $posts_query as $post ) :

		$posts[$post->ID]['id'] = 			$post->ID;
		$posts[$post->ID]['title'] = 		$post->post_title;
		$posts[$post->ID]['name'] = 		$post->post_name;
		$posts[$post->ID]['url'] = 			get_permalink( $post->ID );
		$posts[$post->ID]['image'] = 		getFeaturedImage( get_post_thumbnail_id( $post->ID ) );
		$posts[$post->ID]['author'] = 		get_the_author_meta( 'display_name', $post->post_author );
		$posts[$post->ID]['content'] = 		apply_filters('the_content', $post->post_content);
		$posts[$post->ID]['revisions'] = 	wp_get_post_revisions( $post->ID, array('numberposts' => 3) );

	endforeach;
	
	return $posts;
	wp_reset_postdata();
}

/**
 * Fetch the thumbnail and full image url from featured post/page/custom_post via de image ID
 *
 * @author João Moleiro <jf.moleiro@gmail.com>
 */
function getFeaturedImage($image_id) {
	$media_array = array();
	$media = wp_get_attachment_image_src( $image_id, 'full' );
	$media_array['full'] = $media[0];
	$media = wp_get_attachment_image_src( $image_id, 'thumbnail' );
	$media_array['thumbnail'] = $media[0];

	return $media_array;
}

/**/
function timeAgo( $date ){
	$time = human_time_diff( strtotime( $date ), current_time('timestamp') );
	return $time;
}

/**/
function customComment($comment, $args, $depth) {
	get_template_part( 'templates/comment', 'template' );
}

/* AJAX comments */
add_action('comment_post', 'ajaxify_comments',20, 2);
function ajaxify_comments($comment_ID, $comment_status){
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		//If AJAX Request Then
		switch($comment_status) {
			case '0':
				//notify moderator of unapproved comment
				wp_notify_moderator($comment_ID);
				break;
			case '1': //Approved comment
				echo "success";
				$commentdata = &get_comment($comment_ID, ARRAY_A);
				$post = &get_post($commentdata['comment_post_ID']);
				wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
				break;
			default:
				echo "error";
		}
		exit;
	}
}

?>