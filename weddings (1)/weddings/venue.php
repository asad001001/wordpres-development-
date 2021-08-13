<?php

get_header(); 

?>

<div id="Content" class="single-venue">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		<div class="section carousel_stuff py-5" style="background:url(<?php echo get_site_url()?>/wp-content/plugins/weddings/assets/bg.png)">
				<div class="section_carousel_head">
		           <div id="header_c" class="owl-theme" >
		               <?php 
		               
		               		$gallery_rows = get_field('gallery');
                        if( $gallery_rows ) {
                        
                            foreach( $gallery_rows as $row ) {
                               $image  = $row['image'];
                        ?>
                        
                            <div class="item">	<img width="108" height="40" src="<?php echo $image; ?>"></div> 
                        
                        
                        <?php 
                            }

                        }
		               ?>
            
                         
                    </div>
                </div>
            </div>
             <!--section start -->
            <div class="section container title-sec">
                <div class="row">
                    <div class="col-md-12">
                        	<img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        	<h2><?php the_title();?></h2>
                    </div>
                </div>
            </div>
            <!-- section end-->
               <!--section start -->
            <div class="section container border_b location-sec">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <div class="location">
                            <img src="<?php echo get_site_url();?>/wp-content/uploads/2021/05/Icon-feather-map-pin.png">
                            <?php  echo strip_tags( get_the_term_list( get_the_ID(), 'locations', '', ', ') );?>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="after_title">
                            <li><a href="<?php echo get_site_url();?>/vendors"><img src="<?php echo get_site_url();?>/wp-content/uploads/2021/05/Group-655.png"> Find Venods</a></li>
                            <li><?php echo do_shortcode('[wp_ulike]');?> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- section end-->
               <!--section start -->
            <div class="section container price-sec">
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="price_inner">
                            <img src="<?php echo get_site_url();?>/wp-content/uploads/2021/05/price.png"> 
                            <span class="li_container">
                                    <strong> Price</strong>
                                    <br/> From <?php echo get_field("price"); ?>
                        
                            </span>
                        </div>

                    </div>
                    <div class="col-md-6 text-right location-btn">
                        <a href="#" class="basic_btn extra_padd">contact this venue</a>
                    </div>
                </div>
            </div>
            <!-- section end-->
             <!--section start -->
            <div class="section container  about_inner">
                <div class="row">
                    <div class="col-md-9">
                    
                        <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h2 class="about_inner-head"> About This Venue</h2>
                        <?php echo get_field("about_venue");?>
                        
                    </div>
                    <div class="col-md-3">
                        <h3 class="get-in-head">Get In Touch</h3>
                        <p>Lorem Ipusm switched descu pora setho</p>
                        <a href="#" class="basic_btn normal_padd">contact this venue</a>
                        <div class="soial_icons venue-social"> 
                            <ul>
                                <?php if(get_field('social_icons')['facebook'] != ''){ ?>
                                <li> <a href="<?php echo get_field('social_icons')['facebook']; ?>" > <i class="icon-facebook"></i></a> </li>
                                <?php }?>
                                 
                                 <?php if(get_field('social_icons')['instagram'] != ''){ ?>
                                <li> <a href="<?php echo get_field('social_icons')['instagram']; ?>" > <i class="icon-instagram"></i></a> </li>
                                <?php }?>
                                
                                 <?php if(get_field('social_icons')['linkedin'] != ''){ ?>
                                <li> <a href="<?php echo get_field('social_icons')['linkedin']; ?>" > <i class="icon-linkedin"></i></a> </li>
                                <?php }?>
                                 
                                 <?php if(get_field('social_icons')['twitter'] != ''){ ?>
                                <li> <a href="<?php echo get_field('social_icons')['twitter']; ?>" > <i class="icon-twitter"></i></a> </li>
                                <?php }?>
                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- section end-->
            <!--section start -->
            <div class="section container  facilites">
                <div class="row">
                    <div class="col-md-12">
                        <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="facilites-head"> Venue Facilities </h3>
                                                                       
                                            
                                            
                                        
                        <ul>
                            <?php 
                                $terms = get_terms( array(
                                                'taxonomy' => 'facilities',
                                                'hide_empty' => false,
                                            ) );
                                foreach($terms as $term){
                                         
                                ?>
                            <li class="<?php echo (($term->count >= 1 && has_term($term->name,'facilities',get_the_ID()) )? 'active':' ');?>"><img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($term->term_id); ?>"> <?php echo $term->name;?> </li>
                            <?php } ?>
                        </ul>       
                    </div>
                </div>
            </div>
            <!-- section end-->
            
            
                  <!--section start -->
            <div class="section container  owner_manager">
                <div class="row">
                    <div class="col-md-12">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="owner_manager-head"> Owner / Manager </h3>
                        <?php echo get_field('owner__manager');?>
                        
                    </div>
                </div>
            </div>
            <!-- section end-->
            
            <!--section start -->
            <div class="section container  srounded">
                <div class="row">
                    <div class="col-md-3">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="srounded-head"> Surroundes </h3>
                        <?php echo get_field('surrounded');?>
                        
                    </div>
                    <div class="col-md-9">
                         <?php echo get_field('venue_location_map');?>
                    </div>
                    
                </div>
            </div>
            <!-- section end-->
               <!--section start -->
            <div class="section container  video_inner">
                <div class="row">
                    <div class="col-md-12">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="video-head"> Video </h3>
                        <?php echo get_field('video');?>
                        
                    </div>
                 
                    
                </div>
            </div>
            <!-- section end-->
            
            <!--section start -->
            <div class="section container  video_inner">
                <div class="row">
                    <div class="col-md-9">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="video_inner-head"> Get in touch <br> with this Venue </h3>
                        <h4>Intrusted in this space?</h4>
                        <p>Lorem ipsum seduc usde cksedv wele kalom khadim haji nazir shariq pathan aqeel pagal.</p>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="basic_btn normal_padd">contact this venue</a>
                    </div>
                 
                    
                </div>
            </div>
            <!-- section end-->
            
             <!--section start -->
            <div class="section container  local_vendors">
                <div class="row">
                    <div class="col-md-12">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="local_vendors-head"> Local Vendors </h3>
                    	<div class="local_vendors">
		                    <div id="venu_local_Vendors" class="owl-theme vendor_cards" >
		                      
		                       <?php
		                      
		                        $args = array(
                                    'post_type' => 'vendors',
                                 );
                        
                       $args['meta_query'] = array(
                                array(
                                'key' => 'venue_we_work_with', // name of custom field
                                'value' => get_the_ID(),
                                'compare' => 'LIKE'
                                 ),
                                );
                             $query = new WP_Query( $args );
                       
                          $html = '';
                          
                          while ( $query->have_posts() ) {
                                $query->the_post();
                                
                            $html .='<div class="vendor_card">'; 
                            $html .='<div class="vendor_card_featured-img">';
                            $html .='<a href="'.get_permalink().'"><img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' )[0].'"></a>';
                              $html .='</div>';
                              $html .='<h3 class="vendor_card_title">'.get_the_title().'</h3>';
                              $html .='<span class="vendor_card_like-heart" ><i class="fa fa-heart-o" aria-hidden="true"></i> </span>';
                              $html .='<p class="vendor_card_region">'.strip_tags( get_the_term_list( get_the_ID(), 'locations', '', ', ') ).' </p>';
                             $html .= do_shortcode('[wp_ulike]'); 
                            $html .='</div>';
                          }
                            
		                        
		                        echo $html;
		                        ?>
		                    </div>
		                </div>
                    
                    </div>
                </div>
            </div>
            <!-- section end-->
            
            
        </div>
    </div>
</div>
            
    
<?php get_footer();