<?php 
/*
   Plugin Name: Weddings
   Plugin URI: http://demo7.1stopwebsitesolution.com/
   description: This plugin Will Provide  You the Madicen details and Doctors data.
   Version: 1.0
   Author: Mr. Asad Ali (Sr Web Developer)
   Author URI: http://demo7.1stopwebsitesolution.com/
   License: GPL2
   */



  class Weddings{
    
    function __construct(){
        //   Loading Files
        add_action( 'wp_enqueue_scripts', array($this,'AddingScripts'));
        
         // Register vendors    
          add_action( 'init', array($this,'Register_vendors_post_type') );  
          add_action( 'init', array($this,'Register_vender_texonomy'), 0 );  
        // Register Venues    
        add_action( 'init', array($this,'Register_venues_post_type') );  
        add_action( 'init', array($this,'Register_venues_texonomy'), 0 );   

	   /* Filter the single_template with our custom function*/
		add_filter('single_template', array($this,'my_custom_template'),99);
		
		add_filter( 'archive_template', array($this,'get_custom_post_type_archive') );

		// show vendos list
		add_shortcode('list_vendor_type',array($this,'loading_vendor_type'));
	  
	  
	  
	  add_action( 'wp_ajax_loading_venue_ajax',array($this,'loading_venue_ajax') );
        add_action( 'wp_ajax_nopriv_loading_venue_ajax',array($this,'loading_venue_ajax') );
        
        
        
        add_action( 'wp_ajax_loading_vendors_ajax',array($this,'loading_vendors_ajax') );
        add_action( 'wp_ajax_nopriv_loading_vendors_ajax',array($this,'loading_vendors_ajax') );
        
            
        }
        

 
        function get_custom_post_type_archive( $archive_template ) {
             global $post;
           $dir = plugin_dir_path( __FILE__ );
             
             
              if ( is_post_type_archive('weddingvenues') ) {
                  
                if ( file_exists( $dir.'/archive-venue.php'  )) {
                    
                    $archive_template =  $dir.'/archive-venue.php';
                
                    add_action( 'wp_enqueue_scripts', function(){
                       	  	wp_enqueue_style('wedding-vendor-styles23', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css');
                  		
                  		    wp_enqueue_script( 'wedding_venue_select2_js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js' , false,null);
                  			wp_enqueue_style('wedding-venue_select2_css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false,null);
                  		
                  		
                            wp_enqueue_script( 'script-vendor1', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js' );
                  			wp_enqueue_style('wedding-vendor-styles2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
                  			wp_enqueue_style('wedding-vendor-styles3', plugins_url( '/css/vendors.css', __FILE__ ), false,null);
                            wp_enqueue_script( 'script-vendor3', plugins_url( '/js/vendors.js', __FILE__ ), false,null );
                      });
                    
                    
                }
                
            }else if ( is_post_type_archive ( 'vendors' ) ) {
                
                  add_action( 'wp_enqueue_scripts', function(){
                     
                      	wp_enqueue_style('wedding-vendor-styles23', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css');
                		wp_enqueue_script( 'wedding_venue_select2_js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js' , false,null);
              			wp_enqueue_style('wedding-venue_select2_css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false,null);
                        wp_enqueue_script( 'script-vendor1', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js' );
              			wp_enqueue_style('wedding-vendor-styles2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
              			wp_enqueue_style('wedding-vendor-styles3', plugins_url( '/css/vendors.css', __FILE__ ), false,null);
                        wp_enqueue_script( 'script-vendor3', plugins_url( '/js/vendors.js', __FILE__ ), false,null );
                  });
                      $archive_template = dirname( __FILE__ ) . '/archive-vendors.php';
                  
                 }
                 
                 return $archive_template;
            }
    
    function my_custom_template($single) {
    
        global $post;
    $dir = plugin_dir_path( __FILE__ );
        /* Checks for single template by post type */
        if ( $post->post_type == 'weddingvenues' ) {
            if ( file_exists( $dir.'/venue.php'  )) {
                
                    //loading style
                add_action( 'wp_enqueue_scripts', function(){
                     wp_enqueue_script( 'script-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js' );
              			wp_enqueue_style('wedding-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
                     
                  		wp_enqueue_style('wedding-fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', false,null);
              			wp_enqueue_style('wedding-bootsrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', false,null);
              		    wp_enqueue_script( 'script-proper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', false,null );
                        wp_enqueue_script( 'script-bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', false,null );
                         	wp_enqueue_style('wedding-vendor-styles', plugins_url( '/css/vendors.css', __FILE__ ), false,null);
                       wp_enqueue_script( 'script-vendor3', plugins_url( '/js/inner_services.js', __FILE__ ), false,null );
                    
                });
                  
              
                  
                return $dir.'/venue.php';
                
            }
        }else  if ( $post->post_type == 'vendors' ){
             if ( file_exists( $dir.'/vendor.php')) {
                
                //loading style
                add_action( 'wp_enqueue_scripts', function(){
                     wp_enqueue_script( 'script-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js' );
              			wp_enqueue_style('wedding-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
                      	wp_enqueue_style('wedding-vendor-styles', plugins_url( '/css/vendors.css', __FILE__ ), false,null);
                  		wp_enqueue_style('wedding-vendor-styles1', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', false,null);
              			wp_enqueue_style('wedding-vendor-styles2', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', false,null);
              		
                       wp_enqueue_script( 'script-vendor1', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', false,null );
                       wp_enqueue_script( 'script-vendor2', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', false,null );
                       wp_enqueue_script( 'script-vendor3', plugins_url( '/js/vendors.js', __FILE__ ), false,null );
                  });
                  
                return $dir.'/vendor.php';
             
            }
        }
    
        return $single;
    
    }
    
    function AddingScripts(){
        wp_register_script( 
	    'wedding-script', plugins_url( '/js/wedding.js', __FILE__ ), array('jquery'),null
        );

        wp_localize_script('wedding-script','OBJ', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))
        );
    	
    	wp_enqueue_style('wedding-styles', plugins_url( '/css/wedding.css', __FILE__ ), false,null);
        wp_enqueue_script('wedding-script');

    }


    function Register_venues_post_type(){
        $labels = array(
            'name' => _x( 'Wedding Venues', 'post type general name' ),
            'singular_name' => _x( 'Wedding Venues', 'post type singular name' ),
            'add_new' => _x( 'Add New', 'Venue' ),
            'add_new_item' => __( 'Add New Venue' ),
            'edit_item' => __( 'Edit Venue' ),
            'new_item' => __( 'New Venue' ),
            'all_items' => __( 'All Venues' ),
            'view_item' => __( 'View Venues' ),
            'search_items' => __( 'Search Venues' ),
            'not_found' => __( 'No vendor found' ),
            'not_found_in_trash' => __( 'No Venues found in the Trash' ),
            'parent_item_colon' => '',
            'menu_name' => 'Wedding Venues'
            );
            
            // args array
            
            $args = array(
            'labels' => $labels,
            'description' => 'Displays Venues and their ratings',
            'public' => true,
            'menu_position' => 4,
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive' => true,
            );
            
            register_post_type( 'wedding venues', $args );
    }
    

    
    function Register_venues_texonomy(){
        $labels = array(
            'name' => _x( 'Wedding Venues Type', 'taxonomy general name' ),
            'singular_name' => _x( 'Wedding Venues Type', 'taxonomy singular name' ),
            'search_items' => __( 'Search Wedding Venue Types' ),
            'all_items' => __( 'All Wedding Venue Types' ),
            'parent_item' => __( 'Parent Wedding Venue Type' ),
            'parent_item_colon' => __( 'Parent Wedding Venue Type:' ),
            'edit_item' => __( 'Edit Wedding Venue Type' ),
            'update_item' => __( 'Update Wedding Venue Type' ),
            'add_new_item' => __( 'Add New Wedding Venue Type' ),
            'new_item_name' => __( 'New Wedding Venue Type' ),
            'menu_name' => __( 'Wedding Venue Type' ),
            );
            
            //args array
            
            $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'wedding_venues_type' )
            );
            
            
            
                      // register vendor location 
             $labels_location = array(
            'name' => _x( 'locations', 'taxonomy general name' ),
            'singular_name' => _x( 'location', 'taxonomy singular name' ),
            'search_items' => __( 'Venues location' ),
            'all_items' => __( 'All location' ),
            'parent_item' => __( 'Parent location' ),
            'parent_item_colon' => __( 'Parent location:' ),
            'edit_item' => __( 'Edit Venues' ),
            'update_item' => __( 'Update location' ),
            'add_new_item' => __( 'Add New location' ),
            'new_item_name' => __( 'New location' ),
            'menu_name' => __( '  location' ),
            );
            
            //args array
            
            $args_location = array(
            'labels' => $labels_location,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'locations' )
            );
            
                      // register vendor property 
             $labels_property = array(
            'name' => _x( 'venue property', 'taxonomy general name' ),
            'singular_name' => _x( 'venue property', 'taxonomy singular name' ),
            'search_items' => __( '  Venues property' ),
            'all_items' => __( 'All venue property' ),
            'parent_item' => __( 'Parent venue property' ),
            'parent_item_colon' => __( 'Parent venue property:' ),
            'edit_item' => __( 'Edit Venue property' ),
            'update_item' => __( 'Update venue property' ),
            'add_new_item' => __( 'Add New venue property' ),
            'new_item_name' => __( 'New venue property' ),
            'menu_name' => __( ' venue property' ),
            );
            
            //args array
            
            $args_property = array(
            'labels' => $labels_property,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'venue-property' )
            );
            
                          // register vendor facilities 
             $labels_facilities = array(
            'name' => _x( 'venue facilities', 'taxonomy general name' ),
            'singular_name' => _x( 'venue facilities', 'taxonomy singular name' ),
            'search_items' => __( '  Venues facilities' ),
            'all_items' => __( 'All venue facilities' ),
            'parent_item' => __( 'Parent venue facilities' ),
            'parent_item_colon' => __( 'Parent venue facilities:' ),
            'edit_item' => __( 'Edit Venue facilities' ),
            'update_item' => __( 'Update venue facilities' ),
            'add_new_item' => __( 'Add New venue facilities' ),
            'new_item_name' => __( 'New venue facilities' ),
            'menu_name' => __( ' venue facilities' ),
            );
            
            //args array
            
            $args_facilities = array(
            'labels' => $labels_facilities,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'venue-facilities' )
            );
            
                             // register vendor styles 
             $labels_styles = array(
            'name' => _x( 'venue styles', 'taxonomy general name' ),
            'singular_name' => _x( 'venue styles', 'taxonomy singular name' ),
            'search_items' => __( '  Venues styles' ),
            'all_items' => __( 'All venue styles' ),
            'parent_item' => __( 'Parent venue styles' ),
            'parent_item_colon' => __( 'Parent venue styles:' ),
            'edit_item' => __( 'Edit Venue styles' ),
            'update_item' => __( 'Update venue styles' ),
            'add_new_item' => __( 'Add New venue styles' ),
            'new_item_name' => __( 'New venue styles' ),
            'menu_name' => __( ' venue styles' ),
            );
            
            //args array
            
            $args_styles = array(
            'labels' => $labels_styles,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'venue-styles' )
            );
            
            
             // register vendor accommodation amenitie
             $labels_accommodation_amenitie = array(
            'name' => _x( 'venue accommodation amenities', 'taxonomy general name' ),
            'singular_name' => _x( 'venue accommodation amenities', 'taxonomy singular name' ),
            'search_items' => __( '  Venues accommodation amenities' ),
            'all_items' => __( 'All venue accommodation amenities' ),
            'parent_item' => __( 'Parent venue accommodation amenities' ),
            'parent_item_colon' => __( 'Parent venue accommodation amenities' ),
            'edit_item' => __( 'Edit Venue accommodation amenities' ),
            'update_item' => __( 'Update venue accommodation amenities' ),
            'add_new_item' => __( 'Add New venue accommodation amenities' ),
            'new_item_name' => __( 'New venue accommodation amenities' ),
            'menu_name' => __( ' venue accommodation amenities' ),
            );
            
            //args array
            
            $args_accommodation_amenitie= array(
            'labels' => $labels_accommodation_amenitie,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'accommodation-amenities' )
            );
            
                $labels_accommodation = array(
            'name' => _x( 'venue accommodation', 'taxonomy general name' ),
            'singular_name' => _x( 'venue accommodation ', 'taxonomy singular name' ),
            'search_items' => __( '  Venue accommodation ' ),
            'all_items' => __( 'All venue accommodation ' ),
            'parent_item' => __( 'Parent venue accommodation ' ),
            'parent_item_colon' => __( 'Parent venue accommodation ' ),
            'edit_item' => __( 'Edit Venue accommodation ' ),
            'update_item' => __( 'Update venue accommodation ' ),
            'add_new_item' => __( 'Add New venue accommodation ' ),
            'new_item_name' => __( 'New venue accommodation ' ),
            'menu_name' => __( ' venue accommodation ' ),
            );
            
            //args array
            
            $args_accommodation = array(
            'labels' => $labels_accommodation,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'accommodations' )
            );
          
         register_taxonomy( 'weddingvenuestype', array('weddingvenues'), $args );
         register_taxonomy( 'styles', array('weddingvenues'), $args_styles );
         register_taxonomy( 'accommodationamenities', array('weddingvenues'), $args_accommodation_amenitie );
         register_taxonomy( 'accommodations', array('weddingvenues'), $args_accommodation );
         
         register_taxonomy( 'facilities', array('weddingvenues'), $args_facilities );
         register_taxonomy( 'venuepropertytype', array('weddingvenues'), $args_property );
         register_taxonomy( 'locations', array('weddingvenues','vendors'), $args_location );
    
        
    }
	  
	  
    function Register_vendors_post_type(){
        $labels = array(
            'name' => _x( 'Vendors', 'post type general name' ),
            'singular_name' => _x( 'Vendors', 'post type singular name' ),
            'add_new' => _x( 'Add New', 'Vendors' ),
            'add_new_item' => __( 'Add New Vendors' ),
            'edit_item' => __( 'Edit Vendors' ),
            'new_item' => __( 'New Vendors' ),
            'all_items' => __( 'All Vendors' ),
            'view_item' => __( 'View Vendors' ),
            'search_items' => __( 'Search Vendors' ),
            'not_found' => __( 'No vendor found' ),
            'not_found_in_trash' => __( 'No vendors found in the Trash' ),
            'parent_item_colon' => '',
            'menu_name' => 'Vendors'
            );
            
            // args array
            
            $args = array(
            'labels' => $labels,
            'description' => 'Displays Vendors and their ratings',
            'public' => true,
            'menu_position' => 4,
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive' => true,
            );
            
            register_post_type( 'Vendors', $args );
    }
    

    
    function Register_vender_texonomy(){
      
       //register vender type 
        $labels = array(
            'name' => _x( 'Vendors Type', 'taxonomy general name' ),
            'singular_name' => _x( 'Vendors Type', 'taxonomy singular name' ),
            'search_items' => __( 'Search Vendors Type' ),
            'all_items' => __( 'All Vendors Type' ),
            'parent_item' => __( 'Parent Vendors Type' ),
            'parent_item_colon' => __( 'Parent Vendors Type:' ),
            'edit_item' => __( 'Edit Vendors Type' ),
            'update_item' => __( 'Update Vendors Type' ),
            'add_new_item' => __( 'Add New Vendors Type' ),
            'new_item_name' => __( 'New Vendors Type' ),
            'menu_name' => __( ' Vendors Type' ),
            );
            
            //args array
            
            $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'vendor_type' )
            );
            
            
          
            
            register_taxonomy( 'vendor_type', array('vendors'), $args );
          
    }
 
            function loading_venue_ajax(){
                
                  $args = array(
                            'post_type' => 'weddingvenues',
                        );
                        
                        if(!empty($_POST['s'])){
                            $args['s'] = $_POST['s'];
                        }
                        
                        if(!empty($_POST['guest'])){
                            
                                $args['meta_query'] = array(
                                        array(
                                        'key' => 'number_of_guest', // name of custom field
                                        'value' => $_POST['guest'],
                                        'compare' => 'LIKE'
                                         ),
                                        );
                            }
                            
                        $args['tax_query'] = array( 'relation'=> 'AND' );    
                            
                        if(!empty($_POST['locations'])){
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'locations',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['locations'],
                                ));
                        }
                        
                        if(!empty($_POST['venuepropertytype'])){
                            
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'venuepropertytype',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['venuepropertytype'],
                                ));
                        
                            
                        }
                        if(!empty($_POST['facilities'])){
                            
                           array_push($args['tax_query'] ,array(
                                    'taxonomy' => 'facilities',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['facilities'],
                                ));
                        
                            
                        }
                          if(!empty($_POST['accommodations'])){
                            
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'accommodations',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['accommodations'],
                                ));
                        
                            
                        }
                         if(!empty($_POST['accommodationamenities'])){
                            
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'accommodationamenities',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['accommodationamenities'],
                                ));
                        
                            
                        }
                        if(!empty($_POST['styles'])){
                            
                           array_push($args['tax_query'] ,array(
                                    'taxonomy' => 'styles',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['styles'],
                                ));
                        
                            
                        }
                        
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
        
        if($query->found_posts > 0){
             echo $html;
        }else{
             echo "<h3> Sorry There is no post found<h3>";
        }
           
            
            
            die();
            }
            
            
            function loading_vendors_ajax(){
                
                  $args = array(
                            'post_type' => 'vendors',
                        );
                        
                        if(!empty($_POST['s'])){
                            $args['s'] = $_POST['s'];
                        }
                        
                        if(!empty($_POST['venu_post'])){
                            
                                $args['meta_query'] = array(
                                array(
                                'key' => 'venue_we_work_with', // name of custom field
                                'value' => ((count($_POST['venu_post']) > 1)? $_POST['venu_post'] : $_POST['venu_post'][0]),
                                'compare' => 'LIKE'
                                 ),
                                );
                            }
                            
                            // if(!empty($_POST['locations']) && !empty($_POST['vendortype'])){
                                 $args['tax_query'] = array( 'relation'=> 'AND' );   
                            // }
                            
                        
                            
                        if(!empty($_POST['locations'])){
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'locations',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['locations'],
                                ));
                        }
                        
                        if(!empty($_POST['vendortype'])){
                            
                            array_push($args['tax_query'] , array(
                                    'taxonomy' => 'vendor_type',
                                    'field'    => 'slug',
                                    'terms'    => $_POST['vendortype'],
                                ));
                        
                            
                        }
                      
                  
                       // print_r(count($_POST['venu_post']));
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
        
        if($query->found_posts > 0){
             echo $html;
        }else{
             echo "<h3> Sorry There is no post found<h3>";
        }
           
            
            
            die();
            }
            
}

  $obj = new Weddings();
//   include('Ajaxfilters.php');
   