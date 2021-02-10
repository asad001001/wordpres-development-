<?php

function blogs_listing ($attr){
	$n = $attr['number'];
	 $args = array(  
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $n, 
        'orderby' => 'title', 
        'order' => 'ASC',
    );

    $loop = new WP_Query( $args ); 
 	$html="";      
    while ( $loop->have_posts() ) : $loop->the_post(); 
        $featured_img = wp_get_attachment_image_src( $post->ID );
       
       $html.= '<div class="blog_box"> ';
		if ( $feature_img ) {
           $html.= get_the_post_thumbnail();
			
        }
	   $html.= '<div class="blog_title"> <a href="'.get_permalink().'">'.get_the_post_thumbnail().'</a><h2> '.get_the_title().'</h2>            	        <h6>'.get_the_time('d-M-Y', $post->ID).'</h6><h6>'.do_shortcode('[wp_ulike id="'.$post->ID.'"]').'<span>'.get_comments_number($post->ID).'</span></h6></div></div>';
	
    endwhile;
	return $html;
    wp_reset_postdata(); 
}

add_shortcode( 'blog-list', 'blogs_listing' ); 