<?php
/**
 * Template Name: Archives
 *
 * @package Betheme
 * @author Muffin Group
 */

get_header(); 

?>

<div id="Content" class="archive-vendor">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		<div class="section carousel_stuff" style="background:url(<?php echo get_site_url()?>/wp-content/plugins/weddings/assets/bg.png)">
				<div class="section_carousel_head">
		           <div id="header_c" class="owl-theme" >
		               <?php 
		               
		               		$gallery_rows = get_field('carousel',168);
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
	
		<div class="section heading_stuff">
				<div class="section_wrapper " style="text-align:center;width: 80%;margin: 0 auto;">
        		<h2 style="font-size: 40px;color: #3a4664;line-height: 56px;text-align: center" class="vc_custom_heading main-head"><?php echo get_field('vendor_heading',168);?></h2>
        		<img width="108" height="40" src="<?php echo get_site_url();?>/wp-content/uploads/2021/04/ornament.png">
        		<p><?php echo get_field('vendor_paragraph',168);?></p>
				</div>
		</div>
			<div class="section">
				<div class="vendor_list_container ">
				       <div class="search_filter venue_search_filter">
                            <form action="#" method="get">
                              <div class="form-group form-search">
                                <div class="input-label">Search Venue</div>
                                <input  type="search" placeholder="Type your search.." name="search" id="search-form"
                                />
                                <i class="fa fa-search" aria-hidden="true"></i>
                                 <button type="submit">filter</button>
                              </div>
                            
                              <div class="form-group  cf_element_container">
                                   <label> Please Select Region</label>
                                   <div class="hideable">
                                    <select name="locations" id="" multiple="multiple"  style="width: 100%;height:100px;" class="venu_miltiselect" >
                                      <option value=""  >Please Select Region</option>
                                     <?php 
                                     
                                     $terms = get_terms( array(
                                            'taxonomy' => 'locations',
                                            'hide_empty' => false,
                                        ) );
                                        
                                        foreach($terms as $term){
                                            echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                        }
                                     ?>
                                    </select>
                                     <button type="submit">filter</button>
                                 </div>
                              </div>
                              <div class="form-group cf_element_container">
                                <label> Number of Guest</label>
                                <div class="hideable">
                                    <ul class="">
                                        <li><input type="number" name="guest" class="guest" id="guest"></li>
                                    </ul>  
                                     <button type="submit">filter</button>
                                 </div>
                              </div>
                               <div class="form-group cf_element_container">
                                <label> Proerty Type</label>
                                <div class="hideable">
                                
                                    <select name="venuepropertytype"  multiple="multiple" style="width: 100%;height:100px;" class="venu_miltiselect venu_select_venuepropertytype" >
                                            <?php 
                                               $terms = get_terms( array(
                                                'taxonomy' => 'venuepropertytype',
                                                'hide_empty' => false,
                                            ) );
                                            
                                            foreach($terms as $term){
                                                echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                            }
                                            
                                            ?>
                                           
                                    </select>
                                    <button type="submit">filter</button>
                                </div>                                    
                              </div>
                              
                              <div class="form-group cf_element_container">
                                          <label> Facilities</label>
                                <div class="hideable">
                                
                                    <select name="facilities"  multiple="multiple" style="width: 100%;height:100px;" class="venu_miltiselect venu_select_facilities" >
                                            <?php 
                                               $terms = get_terms( array(
                                                'taxonomy' => 'facilities',
                                                'hide_empty' => false,
                                            ) );
                                            
                                            foreach($terms as $term){
                                                echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                            }
                                            
                                            ?>
                                           
                                    </select>
                                    <button type="submit">filter</button>
                                </div>   

                              </div>
                                 <div class="form-group cf_element_container">
                                          <label> Styles</label>
                                <div class="hideable">
                                
                                    <select name="styles"  multiple="multiple" style="width: 100%;height:100px;" class="venu_miltiselect" >
                                            <?php 
                                               $terms = get_terms( array(
                                                'taxonomy' => 'styles',
                                                'hide_empty' => false,
                                            ) );
                                            
                                            foreach($terms as $term){
                                                echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                            }
                                            
                                            ?>
                                           
                                    </select>
                                    <button type="submit">filter</button>
                                </div>   

                              </div>
                              
                                   <div class="form-group cf_element_container">
                                          <label> Accommodations</label>
                                <div class="hideable">
                                
                                    <select name="accommodations"   multiple="multiple"  style="width: 100%;height:100px;" class=" venu_select_accommodations " >
                                           
                                            <?php 
                                               $terms = get_terms( array(
                                                'taxonomy' => 'accommodations',
                                                'hide_empty' => false,
                                            ) );
                                            
                                            foreach($terms as $term){
                                                echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                            }
                                            
                                            ?>
                                           
                                    </select>
                                    <button type="submit">filter</button>
                                </div>   

                              </div>
                              <div class="form-group cf_element_container">
                                          <label> Accommodations Amenities</label>
                                <div class="hideable">
                                
                                    <select name="accommodationamenities"  multiple="multiple"  style="width: 100%;height:100px;" class=" venu_miltiselect" >
                                             <option value="">Please Select</option>
                                            <?php 
                                               $terms = get_terms( array(
                                                'taxonomy' => 'accommodationamenities',
                                                'hide_empty' => false,
                                            ) );
                                            
                                            foreach($terms as $term){
                                                echo "    <option value='".$term->slug."'>".$term->name."</option>";
                                            }
                                            
                                            ?>
                                           
                                    </select>
                                    <button type="submit">filter</button>
                                </div>   

                              </div>
                            </form>
                          </div>
                          
				    <div class="vendor_cards venu_Cards">
				       
				        
				   <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				   
                           <div class="vendor_card">
                              <div class="vendor_card_featured-img">
                                  <a href="<?php echo get_permalink();?>"><img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' )[0]; ?>"></a>
                              </div>
                              <h3 class="vendor_card_title"><?php the_title(); ?></h3>
                              <span class="vendor_card_like-heart" ><i class="fa fa-heart-o" aria-hidden="true"></i> </span>
                               <p class="vendor_card_region"> <?php 

                             echo strip_tags( get_the_term_list( get_the_ID(), 'locations', '', ', ') );
                            ?>
                              </p>
                            <?php echo do_shortcode('[wp_ulike]');?> 
                            </div>
                    <?php endwhile; endif;?>
				    </div>
				</div>
			</div>
			
		</div>

	</div>
</div>
<div class="loader_container"><div class="loader"></div></div>
<?php get_footer();

// Omit Closing PHP Tags