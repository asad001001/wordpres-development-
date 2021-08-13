<?php

get_header(); 

?>

<div id="Content" class="single-vendor ">
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
                        
                        <!--<div class="price_inner">-->
                        <!--    <img src="<?php //echo get_site_url();?>/wp-content/uploads/2021/05/Group-655.png">-->
                            
                        <!--</div>-->

                    </div>
                    <div class="col-md-6 text-right location-btn">
                        <a href="#" class="basic_btn extra_padd">contact this Vendor</a>
                    </div>
                </div>
            </div>
            <!-- section end-->
             <!--section start -->
            <div class="section container  about_inner">
                <div class="row">
                    <div class="col-md-8">
                    
                        <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h2 class="about_inner-head"> About This Vendor</h2>
                        <?php echo get_field("about_vendor");?>
                        
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo get_field('vendor_enquiries')['vendor_logo']; ?>"/>
                        
                        <h3 class="get-in-head">Get In Touch</h3>
                        <p>Lorem Ipusm switched descu pora setho</p>
                        <a href="#" class="basic_btn normal_padd">contact this venue</a>
                        <div class="soial_icons venue-social"> 
                            <ul>
                                <?php if(get_field('vendor_enquiries')['social_icons']['facebook'] != ''){ ?>
                                <li> <a href="<?php echo get_field('vendor_enquiries')['social_icons']['facebook']; ?>" > <i class="icon-facebook"></i></a> </li>
                                <?php }?>
                                 
                                 <?php if(get_field('vendor_enquiries')['social_icons']['instagram'] != ''){ ?>
                                <li> <a href="<?php echo get_field('vendor_enquiries')['social_icons']['instagram']; ?>" > <i class="icon-instagram"></i></a> </li>
                                <?php }?>
                                
                                 <?php if(get_field('vendor_enquiries')['social_icons']['linkedin'] != ''){ ?>
                                <li> <a href="<?php echo get_field('vendor_enquiries')['social_icons']['linkedin']; ?>" > <i class="icon-linkedin"></i></a> </li>
                                <?php }?>
                                 
                                 <?php if(get_field('vendor_enquiries')['social_icons']['twitter'] != ''){ ?>
                                <li> <a href="<?php echo get_field('vendor_enquiries')['social_icons']['twitter']; ?>" > <i class="icon-twitter"></i></a> </li>
                                <?php }?>
                                
                            </ul>
                        </div>
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
                        <?php echo get_field('vendor_video');?>
                        
                    </div>
                 
                    
                </div>
            </div>
            <!-- section end-->
            
            <!--section start -->
            <div class="section container  video_inner">
                <div class="row">
                    <div class="col-md-9">
                    <img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
                        <h3 class="video_inner-head"> Get in touch <br> with this Vendor </h3>
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
                        <h3 class="local_vendors-head"> Venue you may like </h3>
                    	<div class="local_vendors">
		                    <div id="venu_local_Vendors" class="owl-theme vendor_cards" >
		                      
		                       <?php
		                      
		                        $args = array(
                                    'post_type' => 'weddingvenues',
                                 );
                        
                    //   $args['meta_query'] = array(
                    //             array(
                    //             'key' => 'venue_we_work_with', // name of custom field
                    //             'value' => get_the_ID(),
                    //             'compare' => 'LIKE'
                    //              ),
                    //             );
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