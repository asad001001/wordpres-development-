<?php
/**
 * Enqueue script and styles for child theme
 */
 
 
require('inc/faizan.php');
 
function woodmart_child_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );
add_image_size('popuprelated-thumb',100,100,true);
add_image_size('popup-thumb',135,135,true);
add_image_size('brand-thumb',200,100,true);
add_image_size('addtocartpopup-thumb',76,76,true);

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'slickslider', get_stylesheet_directory_uri() . '/css/slick.css' );
    wp_enqueue_style( 'slickslider-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css' );
    wp_enqueue_style( 'ui-theme', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
    wp_enqueue_style( 'custom-theme', get_stylesheet_directory_uri() . '/css/custom.css' );
    wp_enqueue_style( 'responsive-css', get_stylesheet_directory_uri() . '/css/rwd.css' );
    
    wp_enqueue_script( 'migration-js', get_stylesheet_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'ui-js', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'slickslider-js', get_stylesheet_directory_uri() . '/js/slick.min.js', array(), '1.0.0', true );
  
    
  wp_enqueue_script( 'script-name', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );



############################################################################

// Menu Bar

############################################################################

register_nav_menus( array(
    'footer_2_menu' => 'Second Widget Menu',
    'footer_3_menu' => 'Third Widget Menu',
) );

session_start();
// Shortcodes

add_shortcode('latestCategory', 'latestCategory_shortcode');
function latestCategory_shortcode(){
   ob_start();
   
   include dirname(__FILE__) . '/latestCategory.php';
   
   $output = ob_get_clean();
   
   return $output;
}

// Shortcodes

add_shortcode('ourbrands', 'ourbrands_shortcode');
function ourbrands_shortcode(){
   ob_start();
   
   include dirname(__FILE__) . '/ourbrands.php';
   
   $output = ob_get_clean();
   
   return $output;
}

// Shortcodes

add_shortcode('latestproductslider', 'latestproductslider_shortcode');
function latestproductslider_shortcode(){
   ob_start();
   
   include dirname(__FILE__) . '/inc/latestproductslider.php';
   
   $output = ob_get_clean();
   
   return $output;
}

// Shortcodes

add_shortcode('topsearch', 'topsearch_shortcode');
function topsearch_shortcode(){
   ob_start();
   
   include dirname(__FILE__) . '/inc/topsearch.php';
   
   $output = ob_get_clean();
   
   return $output;
}

// Shortcodes

add_shortcode('addtocartpopup', 'addtocartpopup_shortcode');
function addtocartpopup_shortcode(){
   ob_start();
   
   include dirname(__FILE__) . '/inc/addtocartpopup.php';
   
   $output = ob_get_clean();
   
   return $output;
}

function folder_contents() {

    
    $datacat = array_filter(explode('|',$_POST['pscat']), function($value) { return !is_null($value) && $value !== ''; });
    $databrand = array_filter(explode('|',$_POST['psbrand']), function($value) { return !is_null($value) && $value !== ''; });
    
    
    
$pscat = $datacat;
$ps = $_POST['ps'];
$psbrand = $databrand;
$psprice = $_POST['psprice'];
$sorting = $_POST['pssorting'];
$minprice = $_POST['minprice'];
$maxprice = $_POST['maxprice'];


   //  Asad Code 
	          $args = array(
                            'post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1,
                        );
                    $args['tax_query'] = array( 'relation'=> 'AND' );
                    $args['meta_query'] = array( 'relation'=> 'AND' );
                      
                if(!empty($ps)){
                    
                    $args['s'] = $ps;
            
                }
                
	            if($datacat[0] != ''){
	            
	          array_push($args['tax_query'] , array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $datacat,
                        
                    ));	            
	        }

             if($databrand[0] != ''){
            	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_merk',
                            'field'    => 'slug',
                            'terms'    => $databrand,
                            
                        ));	            
	        }
	        
	       //  pricess
	       
	       if(!empty($minprice) && !empty($maxprice) ){
	           
	         
	           
	           $prs =  array($minprice, $maxprice);
	           
    	            array_push($args['meta_query'] , array(
                        'key' => '_price',
                        'value' => $prs,
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    ));
                }
	       // sorting
	           if($sorting == ''){
	            
                        $args['meta_key'] = '_wc_review_count';
                        $args['orderby'] = 'meta_value_num';
                         $args['order'] = 'DESC';
                 
                }
                
                
             
            
            if($sorting != '' && $sorting == 'rating'){
	            
                        $args['meta_key'] = '_wc_review_count';
                        $args['orderby'] = 'meta_value';
                         $args['order'] = 'DESC';
            }
            
	        if($sorting != '' && $sorting == 'lowest' ){
	            
	            $args['meta_key'] = '_price';
                        $args['orderby'] = 'meta_value_num';
                         $args['order'] = 'asc';
	 
	        }
	        
	        if($sorting != '' && $sorting == 'high' ){
	        
	        
	        $args['meta_key'] = '_price';
                        $args['orderby'] = 'meta_value_num';
                         $args['order'] = 'DESC';
	            
	  
	        }
	   
            if($sorting != '' && $sorting == 'popularity' ){
	            
	            
                        $args['meta_key'] = 'total_sales';
                        $args['orderby'] = 'meta_value';
                        $args['order'] = 'DESC';
            }
            
         
            
            if($sorting != '' && $sorting == 'date' ){
	            
	                    $args['order'] = 'desc';

            }
	       
	       
         if($sorting != '' && $sorting == 'sale') {
                 
                   $args['post__in']  = wc_get_product_ids_on_sale();
                }
	       
            
$html = '';
if(!empty($ps) || !empty($minprice)  || !empty($maxprice) || !empty($pscat)  || !empty($psbrand) ){
    


// 
    
    $datacat = $pscat;
$databrand = $psbrand;
$ps = $ps;

$html = '';

    if(empty($_POST['pscat'])){
        
        $categories = get_terms( ['taxonomy' => 'pa_merk', 'hide_empty' => true] );
            foreach( $categories as $term ) { 
            
                $html.= '<label><input type="checkbox" name="sorting" value="'.$term->slug.'" '.((in_array($term->slug,$databrand))?"checked": '').' class="psbrand-check"    data-tag="'.$term->name.' ('.$term->count.')" >'.$term->name.'<span class="count-category-num">('.$term->count.')</span></label>';
            }
    }else{
        
        $query_args = array(
            'status'    => 'publish',
            'limit'     => -1,
            'category'  => $datacat,
        );
        $data = array();
        foreach( wc_get_products($query_args) as $product ){
            foreach( $product->get_attributes() as $taxonomy => $attribute ){
                $attribute_name = wc_attribute_label( $taxonomy ); 
                foreach ( $attribute->get_terms() as $term ){
                    $data[$taxonomy][$term->slug] = $term->name;
                }
            }
        }

        $attribute_select = $data['pa_merk'];
        foreach ($attribute_select as $val => $result) {
                       $query = new WP_Query( array(
                            'post_type' => 'product','post_status' => array( 'publish' ),'posts_per_page' => -1,
                            's'=>$ps,
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'slug',
                                    'terms'    => $datacat,
                                ),
                                array(
                                    'taxonomy' => 'pa_merk',
                                    'field'    => 'slug',
                                    'terms'    => $val,
                                )
                              
                            ),
                        
                        ));
                    $posts = $query->posts;
                   $html.=  '<label><input type="checkbox" name="sorting" '.((in_array($val,$databrand))?"checked": '').' value="'.$val.'" class="psbrand-check" data-tag="'.$result.' ('.count($posts).')">'.$result.' ('.count($posts).')</label>';
            } 
        }
         $brandresult = $html;
	     $html = '';


// 





// $index_query = new WP_Query($args);

// print_r($index_query);
// die;
ob_start();
$prices = array(5,500);

    // $html.= '<div class="row"><div class="col-12 col-sm-12 results_number">'.((count($index_query->posts) == 0 )?'<h3 class="no_re">Geen resultaten, probeer een andere zoekterm</h3>': '' ).'<b>Total Results: </b><span>'.count($index_query->posts).'</span></div>';
    
    	 // while ($index_query->have_posts()) : $index_query->the_post();
    	 
    	 //    $product = wc_get_product( get_the_ID() );
    	 //    array_push($prices,$product->get_price());
    	 //    wc_get_template_part( 'content', 'product-list_cate' );
      //   	endwhile; wp_reset_postdata();
            $data_p = ob_get_clean();
        	  $min = min($prices);
            $max = max($prices);
            
            $html.= $data_p;
            $html.= '<input type="hidden" class="max_p" value="'.$max.'"><input type="hidden" class="min_p" value="'.$min.'">';  
           $html.= '</div>';
          
        
}else{
    
     $html.= '<div class="row"><div class="col-12 col-sm-12 results_number"><h3 class="no_re">Geen resultaten, probeer een andere zoekterm</h3><b>Total Results: </b><span> 0 </span></div>';


     $html.= '<input type="hidden" class="max_p" value="500"><input type="hidden" class="min_p" value="0">';  
   $html.= '</div>';
}

        $result = array('post_data' => $html,'brands'=> $brandresult);
	     echo  json_encode($result);
        die(); 
}

add_action('wp_ajax_folder_contents', 'folder_contents');
add_action('wp_ajax_nopriv_folder_contents', 'folder_contents');


function get_category_by_search(){
    

    $ps = $_POST['ps'];
    $minprice = $_POST['minprice'];
    $maxprice = $_POST['maxprice'];

             if(!empty($minprice) && !empty($maxprice) ){
	           $prs =  array($minprice, $maxprice);
    	            array_push($args['meta_query'] , array(
                        'key' => '_price',
                        'value' => $prs,
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    ));
                }
                
              $args = array(
                              'post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1,
                        );
            $args['meta_key'] = '_wc_review_count';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
  
    $datacat = array_filter(explode('|',$_POST['pscat']), function($value) { return !is_null($value) && $value !== ''; });
    $databrand = array_filter(explode('|',$_POST['psbrand']), function($value) { return !is_null($value) && $value !== ''; });
    $pscat = $datacat;    
        
        if($_POST['pscat'] != ''){
            
            $catformData = array_filter(explode('|',$_POST['pscat'] ), function($value) { return !is_null($value) && $value !== ''; });
                
        }

        if($_POST['ps'] != ''){
            
            $args['s'] = $ps;
            
        }   
         
         
         $index_query = new WP_Query($args);
        //  category variable
         $data = array();
         $datacheck = array();
         $countd = array();
	     $i=0;
	    //  end category
	   
	   //brand
	     $data_brand = array();
         $datacheck_brand = array();
         $countd_brand = array();
	     $brand_i=0;
	   //brand end
	   
	   
	   
    	$post_data ='';
    	$prices = array();
        $post_data.= '<div class="row"><div class="col-12 col-sm-12 results_number">'.((count($index_query->posts) == 0 )?'<h3 class="no_re">Geen resultaten, probeer een andere zoekterm</h3>':'' ).'<b>Total Results: </b><span>'.count($index_query->posts).'</span></div>';

	    ob_start();
	    while ($index_query->have_posts()) : $index_query->the_post();
	     //end 
	     
	   //  genrate categories
	     $terms = get_the_terms( get_the_ID(), 'product_cat' );
	            foreach($terms as $term){
	                if(!in_array($term->slug,$datacheck)){
                        array_push($datacheck,$term->slug);
                        	 $args2 = array(
                            'post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1,
                        );
                    $args2['tax_query'] = array( 'relation'=> 'AND' );
                        
                        if(!empty($ps)){
                            $args2['s'] = $ps;
                        }
                        
	          array_push($args2['tax_query'] , array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                        
                    ));	
                    
	                   $index_query2 = new WP_Query($args2);
                    
                        $countd[$term->slug] = count($index_query2->posts);
                        $data[$i] =  $term->name."%".$term->slug; 
    	                $i++;
                    }
	            }   
	   //  end categoories
	   
	   //genrate brands
	      $terms = get_the_terms( get_the_ID(), 'pa_merk' );
	            foreach($terms as $term){
	                if(!in_array($term->slug,$datacheck_brand)){
                        array_push($datacheck_brand,$term->slug);
                        	 $argsbrand = array(
                            'post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1,
                        );
                    $argsbrand['tax_query'] = array( 'relation'=> 'AND' );
                        
                        if(!empty($ps)){
                            $argsbrand['s'] = $ps;
                        }
                        
	          array_push($argsbrand['tax_query'] , array(
                        'taxonomy' => 'pa_merk',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                        
                    ));	
                    
	                   $index_query_brand = new WP_Query($argsbrand);
                    
                        $countd_brand[$term->slug] = count($index_query_brand->posts);
                        $data_brand[$brand_i] =  $term->name."%".$term->slug; 
    	                $brand_i++;
                    }
	            }   
    //end brands
	   
	     
	     
	     
	   // products data for_post
        $product = wc_get_product( get_the_ID() );
	    array_push($prices,$product->get_price());
        wc_get_template_part( 'content', 'product-list_cate' );
        endwhile; wp_reset_postdata(); 
        $min = min($prices);
        $max = max($prices);
        $data_p = ob_get_clean();
        $post_data.= $data_p;
        $post_data.= '<input type="hidden" class="max_p" value="'.$max.'"><input type="hidden" class="min_p" value="'.$min.'">';  
        $post_data.= '</div>';
	     // products data ends 
	     
        //  terms category data 
	
	     $ht ='<div class="con_tain"><ul class="parent_ul" style="">';
	     $uniq = array();
	     foreach($data as $d){
	         $uniq = explode('%',$d);
    	     $ht .= '<li class="child_li"><label><input type="checkbox" name="child_sorting_cat" '.((in_array($uniq[1],$catformData))? "checked" :"").' value="'.$uniq[1].'" class="child pscat-check" data-tag="'.$uniq[0].'">'.$uniq[0].'<span class="count-category-num"> ('.$countd[$uniq[1]].')</span></label></li>';
	     }
	     $ht.='</ul></div>';
    // terms categoy data end
    
    
    
     //  terms brand data 
	
	     $brand ='';
	     $uniq = array();
	     foreach($data_brand as $d){
	         $uniq = explode('%',$d);
    	   //  $brand .= '<li class="child_li"><label><input type="checkbox" name="child_sorting_cat" '.((in_array($uniq[1],$catformData))? "checked" :"").' value="'.$uniq[1].'" class="child pscat-check" data-tag="'.$uniq[0].'">'.$uniq[0].'<span class="count-category-num"> ('.$countd[$uniq[1]].')</span></label></li>';
	        $brand.=  '<label><input type="checkbox" name="sorting"  value="'.$uniq[1].'" class="psbrand-check" data-tag="'.$uniq[0].'">'.$uniq[0].' ('.$countd_brand[$uniq[1]].')</label>';     
	                
	   
	     }
	     
    // terms brand data end




	     
	     $result = array('cate'=> $ht,'post_data' => $post_data,'brands'=>$brand);
	     echo  json_encode($result);
	     die;
}

add_action('wp_ajax_get_category_by_search', 'get_category_by_search');
add_action('wp_ajax_nopriv_get_category_by_search', 'get_category_by_search');



function product_checkbox() {
    $product_id = $_POST['product_id'];
     if (!empty($product_id)) {
        WC()->cart->add_to_cart( $product_id ); 
    }
die(); 
}

add_action('wp_ajax_product_checkbox', 'product_checkbox');
add_action('wp_ajax_nopriv_product_checkbox', 'product_checkbox');


function product_uncheckbox() {
    $pro_id = $_POST['pro_id'];
    
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
     if ( $cart_item['product_id'] == $pro_id ) {
          WC()->cart->remove_cart_item( $cart_item_key );
     }
    }

die(); 
}



function to_put_in_cart(){
    
global $woocommerce;    
    
    $dd='';
    $with = ''; 
$ids = array_filter(explode('|',$_POST['id']), function($value) { return !is_null($value) && $value !== ''; });

    $frag = '';
foreach($ids as $id){
    
    $with = explode('/',$id);
    
    $product = wc_get_product($with[0]);


    if($product->get_type() != 'variable'){
        
        $dd = $woocommerce->cart->add_to_cart($with[0], 1 );
   
  
    }else{
        $variations = $product->get_available_variations();
        $variations_id = wp_list_pluck( $variations, 'variation_id' );
        $variations_name = wp_list_pluck( $variations, 'attributes' );
            $vkey = 0;
            foreach($variations_name as $key => $val){
                foreach($val as $df){
                     if($df == $with[1]){
                        $vkey = $key;
                    }                    
                }
        }
        $dd = $woocommerce->cart->add_to_cart( $with[0], 1 ,$variations_id[$vkey]);
 
          
    }
   
}    
     WC_AJAX :: get_refreshed_fragments();

//   $_SESSION['latest_add_product_cart_key'] = '';
    die;
}


add_action('wp_ajax_to_put_in_cart', 'to_put_in_cart');
add_action('wp_ajax_nopriv_to_put_in_cart', 'to_put_in_cart');

wp_enqueue_script('ajax-footer', get_stylesheet_directory_uri() . '/js/ajax-footer.js', array('jquery'));

add_action( 'woocommerce_add_to_cart', 'custom_action_add_to_cart', 20, 6 );
function custom_action_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ){
    $_SESSION['latest_add_product_cart_key'] = $cart_item_key;
}



// after cart table 

// define the woocommerce_after_cart callback 
function action_woocommerce_after_cart( $wccm_after_checkout ) { 

 $args = array('post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1);
$args['tax_query'] = array( 'relation'=> 'AND' );
    array_push($args['tax_query'] , array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => 'kassakoopjes',
                    ));	
                    
$index_query = new WP_Query($args);

$prices = array();

    echo '<div class="row cart_page_row"><div class="col-12"><h3>Onmisbaar voor je aquarium</h3></div>';


	 while ($index_query->have_posts()) : $index_query->the_post();
	        $product = wc_get_product( get_the_ID() );
	        
	    array_push($prices,$product->get_price());
    	  echo '<div class="col-12 col-sm-6 col-md-2 col-gl-2 px-2"><div class="searchbox_pro cart_page">';
            wc_get_template_part( 'content', 'product-list' );
    	   echo '</div></div>';
    	endwhile; wp_reset_postdata(); 
   echo '</div>';
    
    
}; 
         
// add the action 
add_action( 'woocommerce_after_cart', 'action_woocommerce_after_cart', 10, 1 ); 

// end after cart tabel




add_action('wp_ajax_product_uncheckbox', 'product_uncheckbox');
add_action('wp_ajax_nopriv_product_uncheckbox', 'product_uncheckbox');



function product_searchcategory() {
//     $datacat = array_filter(explode('|',$_POST['pscat']), function($value) { return !is_null($value) && $value !== ''; });
// $databrand = array_filter(explode('|',$_POST['psbrand']), function($value) { return !is_null($value) && $value !== ''; });
// $ps = $_POST['ps'];

// $html = '';

//     if(empty($_POST['pscat'])){
        
//         $categories = get_terms( ['taxonomy' => 'pa_merk', 'hide_empty' => true] );
//             foreach( $categories as $term ) { 
            
//                 $html.= '<label><input type="checkbox" name="sorting" value="'.$term->slug.'" '.((in_array($term->slug,$databrand))?"checked": '').' class="psbrand-check"    data-tag="'.$term->name.' ('.$term->count.')" >'.$term->name.'<span class="count-category-num">('.$term->count.')</span></label>';
//             }
//     }else{
        
//         $query_args = array(
//             'status'    => 'publish',
//             'limit'     => -1,
//             'category'  => $datacat,
//         );
//         $data = array();
//         foreach( wc_get_products($query_args) as $product ){
//             foreach( $product->get_attributes() as $taxonomy => $attribute ){
//                 $attribute_name = wc_attribute_label( $taxonomy ); 
//                 foreach ( $attribute->get_terms() as $term ){
//                     $data[$taxonomy][$term->slug] = $term->name;
//                 }
//             }
//         }

//         $attribute_select = $data['pa_merk'];
//         foreach ($attribute_select as $val => $result) {
//                       $query = new WP_Query( array(
//                             'post_type' => 'product','post_status' => array( 'publish' ),
//                             's'=>$ps,
//                             'tax_query' => array(
//                                 'relation' => 'AND',
//                                 array(
//                                     'taxonomy' => 'product_cat',
//                                     'field'    => 'slug',
//                                     'terms'    => $datacat,
//                                 ),
//                                 array(
//                                     'taxonomy' => 'pa_merk',
//                                     'field'    => 'slug',
//                                     'terms'    => $val,
//                                 )
                              
//                             ),
                        
//                         ));
//                     $posts = $query->posts;
//                   $html.=  '<label><input type="checkbox" name="sorting" '.((in_array($val,$databrand))?"checked": '').' value="'.$val.'" class="psbrand-check" data-tag="'.$result.' ('.count($posts).')">'.$result.' ('.count($posts).')</label>';
//             } 
//         }
//          $result = array('brand' => $html);
// 	     echo  json_encode($result);
    die; 
}

add_action('wp_ajax_product_searchcategory', 'product_searchcategory');
add_action('wp_ajax_nopriv_product_searchcategory', 'product_searchcategory');


// function product_popupcartaddtocart() {
// $pro_id = $_POST['proid'];
// $args = array(
//     'post_type' => 'product',
//     'posts_per_page' => 1,
//     'post__in'=> array($pro_id)
// );    
    
// $popup_data = new WP_Query($args);

// if ( $popup_data->have_posts() ) :
// $popup_data->have_posts(); $popup_data->the_post();
// $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'addtocartpopup-thumb'); 
// $permalink = get_permalink( $pro_id );
// $title = get_the_title($pro_id);
// $product = wc_get_product( $pro_id );
// $price = $product->get_price_html();

// echo '
// <div class="addtocart-prodetail">
//         <div class="row">
//             <div class="col-12 col-sm-12 col-md-8 col-lg-8">
//                 <div class="addtocart-detail">
//                     <div class="row">
//                         <div class="col-12 col-sm-10 col-md-10 col-lg-10">
//                             <div class="addtocart-thumb">
//                                 <a href="'; echo $permalink; echo '"><img src="'; echo $featured_img_url; echo '" alt="" class="img-fluid"></a>
//                             </div>
//                             <div class="addtocart-title">
//                                 <h3><a href="'; echo $permalink; echo '">'; echo $title; echo '</a></h3>
//                             </div>
                            
//                         </div>
//                         <div class="col-12 col-sm-2 col-md-2 col-lg-2">
//                             <div class="addtocart-price">'; echo $price; echo '</div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-12 col-sm-12 col-md-4 col-lg-4">
//                 <div class="addtocartpopup-btn">
//                     <div class="cart-addtocart"><a href="'; echo get_site_url(); echo '/cart">Ik ga bestellen </a></div>
//                     <div class="contniue-shiping-close">
//                         <a href="javascript:;" class="mfp-close">Continue Shopping</a>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
//     <div class="recommended-pro-addtocart">
//          <div class="related-product-popup-info">';
//          $product = new WC_Product($pro_id);
//                     $upsells = $product->get_upsells();
//                   if (!$upsells)
//                         return;
                
//                 $meta_query = WC()->query->get_meta_query();
                
//                     $args = array(
//                         'post_type' => 'product',
//                         'ignore_sticky_posts' => 1,
//                         'no_found_rows' => 1,
//                         'posts_per_page' => -1,
//                         'orderby' => $orderby,
//                         'post__in' => $upsells,
//                         'post__not_in' => array($product->id),
//                         'meta_key' => '_sale_price',
//                         'meta_value' => '0',
//                         'meta_compare' => '>=',
//                         'meta_query' => $meta_query
//                     );
                
//                     $products = new WP_Query($args);
//                     if ($products->have_posts()) :
//           echo '<div class="pp-rel-head">
//             <h3 class="trs-slider-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
//             Recommended products</font></font></h3></div>
//             <div class="pp-rel-slider">
//             <div class="row">';
                    
//                     while( $products->have_posts() ) : $products->the_post();
//                     echo '<div class="col-12 col-sm-4 col-md-4 col-lg-4">
//                       <label class="popup-checkcard">
//                       <div class="pp-rel-slider-info">';
//                           echo '
//                           <input type="checkbox" id="'; echo get_the_ID(); echo '" class="checkbox-pop"/>
//                           <div class="pp-pro-thumb">';
//                               the_post_thumbnail('popuprelated-thumb', array('class' => 'img-fluid'));
//                           echo '</div>
//                           <div class="pp-pro-info">
//                               <h2>'; the_title(); echo '</h2>
//                               <div class="price-pp">';
//                                   echo $product->get_price();
//                               echo '</div>
//                               <div class="pp-delivery">
//                             <i class="fa fa-check-circle" aria-hidden="true"></i> Delivered tomorrow 
//                               </div>';
                           
//                           echo '</div>
//                       </div>
                       
//                       </label>
//                   </div>';
//                   endwhile;
//         echo '</div>
//         </div>';
//         endif;
//             echo '</div>
//         </div>
// ';


// endif;    
//     die(); 
// }

// add_action('wp_ajax_product_popupcartaddtocart', 'product_popupcartaddtocart');
// add_action('wp_ajax_nopriv_product_popupcartaddtocart', 'product_popupcartaddtocart');



/****************************Custom Theme Option**************************/


function wpdocs_scripts_method()
{
	if (is_admin()) {
		wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/jscolor.js', array('jquery'));
	}
}
add_action('admin_enqueue_scripts', 'wpdocs_scripts_method');

add_action('admin_menu', 'theme_option_menu');
function theme_option_menu()
{
	add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'theme-options', 'form_function_show');
	add_action('admin_init', 'register_my_theme_settings');
}


function register_my_theme_settings()
{
	//register our settings

	register_setting('theme_option', 'usp_color');
	register_setting('theme_option', 'usp_text');
	register_setting('theme_option', 'usp_1');
	register_setting('theme_option', 'usp_2');
	register_setting('theme_option', 'beglium_aftertext');
	register_setting('theme_option', 'beglium_beforetext');
	register_setting('theme_option', 'beglium_suntext');
	register_setting('theme_option', 'get_minutes');
	register_setting('theme_option', 'get_houres');


	register_setting('theme_option', 'mon_beforetext');
	register_setting('theme_option', 'mon_hh');
	register_setting('theme_option', 'mon_mm');
	register_setting('theme_option', 'mon_aftertext');

	register_setting('theme_option', 'tue_beforetext');
	register_setting('theme_option', 'tue_hh');
	register_setting('theme_option', 'tue_mm');
	register_setting('theme_option', 'tue_aftertext');

	register_setting('theme_option', 'wed_beforetext');
	register_setting('theme_option', 'wed_hh');
	register_setting('theme_option', 'wed_mm');
	register_setting('theme_option', 'wed_aftertext');

	register_setting('theme_option', 'thu_beforetext');
	register_setting('theme_option', 'thu_hh');
	register_setting('theme_option', 'thu_mm');
	register_setting('theme_option', 'thu_aftertext');

	register_setting('theme_option', 'fri_beforetext');
	register_setting('theme_option', 'fri_hh');
	register_setting('theme_option', 'fri_mm');
	register_setting('theme_option', 'fri_aftertext');

	register_setting('theme_option', 'sat_beforetext');
	register_setting('theme_option', 'sat_hh');
	register_setting('theme_option', 'sat_mm');
	register_setting('theme_option', 'sat_aftertext');

	register_setting('theme_option', 'sun_beforetext');
	register_setting('theme_option', 'sun_hh');
	register_setting('theme_option', 'sun_mm');
	register_setting('theme_option', 'sun_aftertext');
}
function form_function_show()
{
?>
	<div class="wrap">
		<h2><?php echo __('Theme Options') ?></h2>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields('theme_option'); ?>

			<h2>USP Text in product detail page</h2>
			<table style="width: 100%">

				<tr style="width: 100%">
					<td style="width: 20%">Enter Content: </td>
					<td>
						<textarea name="usp_text" id="usp_text" rows="10" cols="80"><?php echo get_option('usp_text'); ?></textarea>
					</td>
				</tr>
				<tr>
					<td style="width: 20%">USP Color: </td>
					<td>
						<input class='jscolor' name='usp_color' value="<?php echo get_option('usp_color'); ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 20%">USP 1: </td>
					<td>
						<input class='usp_1' type="text" name='usp_1' value="<?php echo get_option('usp_1'); ?>" size="100%">
					</td>
				</tr>
				<tr>
					<td style="width: 20%">USP 2: </td>
					<td>
						<input class='usp_2' type="text" name='usp_2' value="<?php echo get_option('usp_2'); ?>" size="100%">
					</td>
				</tr>
			</table>

			<h2>Bezorgtijden :-</h2>

			<table style="width: 75%;">
				<tr>
					<th style="width: 20%">Day</th>
					<th style="width: 30%">Before Sentence</th>
					<th style="width: 20%">Break Time</th>
					<th style="width: 30%">After Sentence</th>
				</tr>
				<tr>
					<th style="width: 20%">Mon</th>
					<th style="width: 30%">
						<input style="width: 100%" id="mon_beforetext" name='mon_beforetext' value="<?php echo get_option('mon_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="mon_hh" placeholder="HH" maxlength="2" name='mon_hh' value="<?php echo get_option('mon_hh'); ?>">
						<input style="width: 24%" id="mon_mm" placeholder="MM" maxlength="2" name='mon_mm' value="<?php echo get_option('mon_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="mon_aftertext" name='mon_aftertext' value="<?php echo get_option('mon_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">The</th>
					<th style="width: 30%">
						<input style="width: 100%" id="tue_beforetext" name='tue_beforetext' value="<?php echo get_option('tue_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="tue_hh" placeholder="HH" placeholder="HH" maxlength="2" name='tue_hh' value="<?php echo get_option('tue_hh'); ?>">
						<input style="width: 24%" id="tue_mm" placeholder="MM" maxlength="2" name='tue_mm' value="<?php echo get_option('tue_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="tue_aftertext" name='tue_aftertext' value="<?php echo get_option('tue_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">Wed</th>
					<th style="width: 30%">
						<input style="width: 100%" id="wed_beforetext" name='wed_beforetext' value="<?php echo get_option('wed_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="wed_hh" placeholder="HH" placeholder="HH" maxlength="2" name='wed_hh' value="<?php echo get_option('wed_hh'); ?>">
						<input style="width: 24%" id="wed_mm" placeholder="MM" maxlength="2" name='wed_mm' value="<?php echo get_option('wed_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="wed_aftertext" name='wed_aftertext' value="<?php echo get_option('wed_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">Thu</th>
					<th style="width: 30%">
						<input style="width: 100%" id="thu_beforetext" name='thu_beforetext' value="<?php echo get_option('thu_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="thu_hh" placeholder="HH" placeholder="HH" maxlength="2" name='thu_hh' value="<?php echo get_option('thu_hh'); ?>">
						<input style="width: 24%" id="thu_mm" placeholder="MM" maxlength="2" name='thu_mm' value="<?php echo get_option('thu_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="thu_aftertext" name='thu_aftertext' value="<?php echo get_option('thu_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">Fri</th>
					<th style="width: 30%">
						<input style="width: 100%" id="fri_beforetext" name='fri_beforetext' value="<?php echo get_option('fri_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="fri_hh" placeholder="HH" maxlength="2" name='fri_hh' value="<?php echo get_option('fri_hh'); ?>">
						<input style="width: 24%" id="fri_mm" placeholder="MM" maxlength="2" name='fri_mm' value="<?php echo get_option('fri_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="fri_aftertext" name='fri_aftertext' value="<?php echo get_option('fri_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">Sat</th>
					<th style="width: 30%">
						<input style="width: 100%" id="sat_beforetext" name='sat_beforetext' value="<?php echo get_option('sat_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="sat_hh" placeholder="HH" maxlength="2" name='sat_hh' value="<?php echo get_option('sat_hh'); ?>">
						<input style="width: 24%" id="sat_mm" placeholder="MM" maxlength="2" name='sat_mm' value="<?php echo get_option('sat_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="sat_aftertext" name='sat_aftertext' value="<?php echo get_option('sat_aftertext'); ?>">
					</th>
				</tr>
				<tr>
					<th style="width: 20%">Sun</th>
					<th style="width: 30%">
						<input style="width: 100%" id="sun_beforetext" name='sun_beforetext' value="<?php echo get_option('sun_beforetext'); ?>">
					</th>
					<th style="width: 20%">
						<input style="width: 22%" id="sun_hh" placeholder="HH" maxlength="2" name='sun_hh' value="<?php echo get_option('sun_hh'); ?>">
						<input style="width: 24%" id="sun_mm" placeholder="MM" maxlength="2" name='sun_mm' value="<?php echo get_option('sun_mm'); ?>">
					</th>
					<th style="width: 30%">
						<input style="width: 100%" id="sun_aftertext" name='sun_aftertext' value="<?php echo get_option('sun_aftertext'); ?>">
					</th>
				</tr>

			</table>


			<!--
			<table style="width: 100%">
				<tr style="width: 100%">
					<td style="width: 20%">Enter Text here (Before 12:30)</td>
					<td>
						<input style="width: 50%" id="beglium_beforetext" name='beglium_beforetext' value="<?php echo get_option('beglium_beforetext'); ?>">

					</td>
				</tr>
				<tr style="width: 100%">
					<td style="width: 20%">Enter Text here (After 12:30)</td>
					<td>
						<input style="width: 50%" id="beglium_aftertext" name='beglium_aftertext' value="<?php echo get_option('beglium_aftertext'); ?>">

					</td>
				</tr>
				<tr style="width: 100%">
					<td style="width: 20%">Enter Text here (Saturday,sunday,friday(after 10:30))</td>
					<td>
						<input style="width: 50%" id="beglium_suntext" name='beglium_suntext' value="<?php echo get_option('beglium_suntext'); ?>">

					</td>
				</tr>
				<tr style="width: 100%">
					<td style="width: 40%">Hours</td>
					<td>
						<input  name='get_houres' id="get_houres" value="<?php echo get_option('get_houres'); ?>">
					</td>
				</tr>
				<tr style="width: 100%">
					<td style="width: 40%">Minutes</td>
					<td>
						<input  name='get_minutes' id="get_minutes" value="<?php echo get_option('get_minutes'); ?>">
					</td>
				</tr>
			</table>
-->



			<?php
			submit_button(); ?>
		</form>
	</div>
<?php
}

add_shortcode('begliumcounter', 'begliumcounterfn');
function begliumcounterfn()
{

	//~ register_setting( 'theme_option', 'fri_beforetext' );
	//~ register_setting( 'theme_option', 'fri_hh' );
	//~ register_setting( 'theme_option', 'fri_mm' );
	//~ register_setting( 'theme_option', 'fri_aftertext' );


	$current = date('H:i', current_time('timestamp', 0));
	$week = strtolower(date('D', current_time('timestamp', 0)));

	$current_time = strtotime($current);

	$beack = get_option($week . '_hh') . ':' . get_option($week . '_mm');
	$beacktime = date_create_from_format('H:i', $beack);
	$beacktime = strtotime(date_format($beacktime, "H:i"));


	if ($current_time < $beacktime) {
		$text = get_option($week . '_beforetext');
		$text = str_replace('%h', '<strong class="hour_count"></strong>', $text);
		$text = str_replace('%m', '<strong class="minutes_count"></strong>', $text);
		$text = str_replace('[', '<span>', $text);
		$text = str_replace(']', '</span>', $text);
	} else {
		$text = get_option($week . '_aftertext');
		$text = str_replace('%h', '<strong class="hour_count"></strong>', $text);
		$text = str_replace('%m', '<strong class="minutes_count"></strong>', $text);
		$text = str_replace('[', '<span>', $text);
		$text = str_replace(']', '</span>', $text);
	}
	// echo $text;
	$output = '<div class="future_date"><i class="fa fa-check-circle check-right our-right"></i>  ' . $text . '</div>';
	// $output ='<div class="future_date">Aanbevolen producten</div>';
	return $output;
}

function midnight_ajax()
{
	$current = date('H:i', current_time('timestamp', 0));
	$week = strtolower(date('D', current_time('timestamp', 0)));

	$current_time = strtotime($current);

	$beack = get_option($week . '_hh') . ':' . get_option($week . '_mm');
	$beacktime = date_create_from_format('H:i', $beack);
	$beacktime = strtotime(date_format($beacktime, "H:i"));
	$distance = $beacktime - $current_time;
	$hour = date('H', $distance);
	$minit = date('i', $distance);

	if ($current_time < $beacktime) {
		$text = get_option($week . '_beforetext');
		$text = str_replace('%h', '<strong class="hour_count"></strong>', $text);
		$text = str_replace('%m', '<strong class="minutes_count"></strong>', $text);
		$text = str_replace('[', '<span>', $text);
		$text = str_replace(']', '</span>', $text);
	} else {
		$text = get_option($week . '_aftertext');
		$text = str_replace('%h', '<strong class="hour_count"></strong>', $text);
		$text = str_replace('%m', '<strong class="minutes_count"></strong>', $text);
		$text = str_replace('[', '<span>', $text);
		$text = str_replace(']', '</span>', $text);
	}

	// $output ='<div id="future_date">'.$text.'</div>';
	echo json_encode(array('output' => $text, 'hour' => $hour, 'minit' => $minit));
}
add_action('wp_ajax_midnight_ajax', 'midnight_ajax');
add_action('wp_ajax_nopriv_midnight_ajax', 'midnight_ajax');


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
function woocommerce_template_single_excerpt()
{

	//~ $discription = get_option('usp_text');
	//$discription = get_field('usps');
	//~ echo do_shortcode($discription);
	if (get_option('usp_1')) {
		echo '<ul class="usps_list"><li>' . get_option('usp_1') . '</li></ul>';
	}
	echo '<div class="begliumcounter_oncart">';
	if (get_option('usp_2')) {
		echo '<div class="future_date"><i class="fa fa-check-circle check-right our-right"></i>' . get_option('usp_2') . '</div>';
	}
	echo do_shortcode('[begliumcounter]');
	echo '</div>';
}

function remove_item_from_cart() {
	$cart = WC()->instance()->cart;
	global $woocommerce;

	session_start();
	if($_POST['qty']==1)
	{
		$_SESSION['latest_add_product_cart_key']='';
	}

	$woocommerce->cart->set_quantity( $_POST['key'], $_POST['qty'] - 1, true  );
	echo $woocommerce->cart->cart_contents_count;
	die;
}
add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');


function register_shipment_arrival_order_status()
{
	register_post_status('wc-ter-controle', array(
		'label'                     => 'Ter controle',
		'public'                    => true,
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop('Ter controle <span class="count">(%s)</span>', 'Ter controle <span class="count">(%s)</span>')
	));
}
add_action('init', 'register_shipment_arrival_order_status');

function add_ter_controle_to_order_statuses($order_statuses)
{
	$order_statuses['wc-ter-controle'] = 'Ter controle'; //background: #f97122 !important;
	return $order_statuses;
}
add_filter('wc_order_statuses', 'add_ter_controle_to_order_statuses');

add_action('admin_head', 'styling_admin_order_list');
function styling_admin_order_list()
{
	global $pagenow;
	if ($_GET['post_type'] == 'shop_order' && $pagenow == 'edit.php') :

		// HERE below set your custom status
		$order_status = 'Ter controle'; // <==== HERE
?>
		<style>
			.order-status.status-<?= sanitize_title($order_status); ?> {
				background: #f97122 !important;
				color: #ffffff;
			}
		</style>
	<?php
	endif;
}
