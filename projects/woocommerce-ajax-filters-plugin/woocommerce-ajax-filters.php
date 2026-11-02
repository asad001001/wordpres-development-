<?php
/*
   Plugin Name: Woocommerce Filters
   Plugin URI: http://hashehouse.com
   description: This plugin Will Provide  You filters functionality.
   Version: 1.0
   Author: Mr. Asad Ali (Sr Web Developer)
   Author URI: http://hashehouse.com
   License: GPL2
   */
  
  class WwooxommersFilters{
    
    function __construct(){
        
        add_action( 'wp_enqueue_scripts', array($this,'AddingScripts'));

        add_action( 'wp_ajax_featchResults',array($this,'featchResults') );
        add_action( 'wp_ajax_nopriv_featchResults',array($this,'featchResults') );

        // show Filters list
		add_shortcode('ShowFilters',array($this,'ShowFilters'));
		add_shortcode('yearFilter',array($this,'yearFilter'));
		add_shortcode('workingHeight',array($this,'workingHeight'));
	
		

    }

    function AddingScripts(){
        wp_register_script( 
	    'ajax-script', plugins_url( '/js/ajax_script.js', __FILE__ ), array('jquery'),null
        );
        
        wp_enqueue_style('filtes-css', plugins_url( '/css/style.css', __FILE__ ));

        wp_localize_script('ajax-script','OBJ', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))
        );
    	wp_enqueue_script('ajax-script');

    }

    function ShowFilters($attr){

        $term = $attr['cat'];
        $hierarchies = $this->get_taxonomy_hierarchy_multiple( array( $term, 'post_tag' ) );
       
        $this->printTree($hierarchies);

    }



    function get_taxonomy_hierarchy( $taxonomy, $parent = 0 ) {
        // only 1 taxonomy
        $taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;
        // get all direct descendants of the $parent
        $terms = get_terms( $taxonomy, array( 'parent' => $parent ) );
        // prepare a new array.  these are the children of $parent
        // we'll ultimately copy all the $terms into this new array, but only after they
        // find their own children
        $children = array();
        // go through all the direct descendants of $parent, and gather their children
        foreach ( $terms as $term ){
            // recurse to get the direct descendants of "this" term
            $term->children = $this->get_taxonomy_hierarchy( $taxonomy, $term->term_id );
            // add the term to our new array
            $children[ $term->term_id ] = $term; //array("name"=>$term->name,"slug"=>$term->slug,"id"=>$term->term_id);
        }
        // send the results back to the caller
        return $children;
    }
    function get_taxonomy_hierarchy_multiple( $taxonomies, $parent = 0 ) {
        if ( ! is_array( $taxonomies )  ) {
            $taxonomies = array( $taxonomies );
        }
        $results = array();
        foreach( $taxonomies as $taxonomy ){
            $terms = $this->get_taxonomy_hierarchy( $taxonomy, $parent );
            if ( $terms ) {
                $results[ $taxonomy ] = $terms;
            }
        }
        return $results;
    }

    function printTree($hierarchies, $p = null) {
        foreach ($hierarchies as $parents) {
            // load parents
            echo "<ul class='parent'>";
            foreach ($parents as $parent) {
                // child
                echo  "<li><label><input type='checkbox' name='".$parent->taxonomy."[]' value='".$parent->term_id."' id='".$parent->taxonomy."".$parent->term_id."'  data-id='".$parent->term_id."' class='filter_li_checkbox' data-type='".$parent->taxonomy."' data-slug='".$parent->slug."'> <span>".$parent->name."</span></label>";
                
                if( count($parent->children) > 0){
                    
                    echo "<ul class='child'>";
                    // inner child
                    foreach ($parent->children as $child) {
                    
                        echo  "<li><label><input type='checkbox' name='".$child->taxonomy."[]' value='".$child->term_id."' id='".$child->taxonomy."".$child->term_id."'  data-id='".$child->term_id."' class='filter_li_checkbox' data-type='".$child->taxonomy."' data-slug='".$child->slug."'> <span>".$child->name."</span></label>";
                         if( count($parent->children) > 0){
                             // final inner child
                             echo "<ul class='inner_child'>";
                                foreach ($child->children as $innerchild) {
                                
                                    echo  "<li><label><input type='checkbox' name='".$innerchild->taxonomy."[]' value='".$innerchild->term_id."' id='".$innerchild->taxonomy."".$innerchild->term_id."'  data-id='".$innerchild->term_id."' class='filter_li_checkbox' data-type='".$innerchild->taxonomy."' data-slug='".$innerchild->slug."'> <span>".$innerchild->name."</span></label>";
                                     if( count($parent->children) > 0){
                                         // final inner child
                                         echo "<ul class='inner_child'>";
                                            foreach ($innerchild->children as $mostinnerchild) {
                                            
                                                echo  "<li><label><input type='checkbox' name='".$mostinnerchild->taxonomy."[]' value='".$mostinnerchild->term_id."' id='".$mostinnerchild->taxonomy."".$mostinnerchild->term_id."'  data-id='".$mostinnerchild->term_id."' class='filter_li_checkbox' data-type='".$mostinnerchild->taxonomy."' data-slug='".$mostinnerchild->slug."'> <span>".$mostinnerchild->name."</span></label></li>";
                                                
                                            }
                                         echo "</ul>";
                                     }
                                     
                                     echo "</li>";
                                }
                             echo "</ul>";
                         }
                         
                         echo "</li>";
                    }
                    
                    echo "</ul>";
                }
                
                echo "</li>";
            }
            echo "</ul>";
    
        }
    }
    
    // show year
    function yearFilter(){
        ?>
        <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-1.10.2.js">
        </script>
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js">
        </script>
        <?php
        $terms = get_terms( 'pa_model-year', array( 'parent' => $parent ) );
    
    
        ?>
        <div class="slider_range">
            <div id="year-range"></div>
            <div class="row extra_padding">
                <div  class="col-md-6">
                    <span id="year-start"><?php echo $terms[0]->name; ?></span>
                    <input type="hidden" value="<?php echo $terms[0]->name; ?>" id="year-min"/>
                </div>
                <div  class="col-md-6 text-right">
                    <span id="year-end"><?php echo $terms[(count($terms)-1)]->name; ?></span>
                    <input type="hidden" value="<?php echo $terms[(count($terms)-1)]->name; ?>" id="year-max"/>
                    
                </div>
            </div>            
        </div>
        <script>
                $(document).ready(function(){
                        var minYear =0;
                        var maxYear =0;
            
                           minYear = "<?php echo $terms[0]->name; ?>"
                           minYear = parseInt(minYear);
                           maxYear = "<?php echo $terms[(count($terms)-1)]->name; ?>"
                           maxYear = parseInt(maxYear);
                    	$( "#year-range" ).slider({
                              range: true,
                              min: minYear,
                              max: maxYear,
                              values: [ minYear, maxYear],
                              slide: function( event, ui ) {
                                  $( "#year-start" ).html( ui.values[ 0 ]);
                                  $( "#year-end" ).html( ui.values[ 1 ] );
                                  $( "#year-min" ).val( ui.values[ 0 ]);
                                  $( "#year-max" ).val( ui.values[ 1 ] );
                              },
                              stop: function (event, ui){
      
                                      hitAjax();
                                    
                                    
                                  }
                                  }); 
                    });
        </script>
        <?php
    }
    
    // show year
    function workingHeight(){
   
        $terms = get_terms( 'pa_working-height-m', array( 'parent' => $parent ) );
    
    
        ?>
        <div class="slider_range">
            <div id="height-range"></div>
            <div class="row extra_padding">
                <div  class="col-md-5">
                    <span id="height-start">3 m / 9' 11ft</span>
                    <input type="hidden" value="3" id="height-min"/>
                    <input type="hidden" value="9.11 " id="ft-min"/>
                </div>
                <div  class="col-md-7 text-right">
                    <span id="height-end">60 m / 196'ft</span>
                    <input type="hidden" value="60" id="height-max"/>
                    <input type="hidden" value="196.00" id="ft-max"/>
                </div>
            </div>            
        </div>
        <script>
                $(document).ready(function(){

        
        var min_value =3;
        var max_value =60;
        
        $( "#height-range" ).slider({
            range: true,
            min: 3,
            max: 60,
            values: [ min_value, max_value],
            slide: function( event, ui ) {

            },
            stop: function( event, ui ) {
                
               var wheight = ui.values[ 0 ] / 0.0254;
                wheight = Math.ceil(wheight);
                var inch = wheight % 12;

                inch = (inch !== 0 ? Math.round(inch) : "");
                var ftmin = (wheight - inch) / 12;
                
                 $( "#ft-min" ).val( ftmin +"."+ inch);
                
                ftmin = (ftmin !== 0 ? Math.round(ftmin) + "' " : "");
                ftmin = ftmin + inch;
                
                
                
                var wheight = ui.values[ 1 ] / 0.0254;
                wheight = Math.ceil(wheight);
                var inch = wheight % 12;

                inch = (inch !== 0 ? Math.round(inch) : "");
                var ftmax = (wheight - inch) / 12;
                
                $( "#ft-max" ).val( ftmax +"."+ inch );
                
                ftmax = (ftmax !== 0 ? Math.round(ftmax) + "' " : "");
                ftmax = ftmax + inch;
                
                $( "#height-start" ).html( ui.values[ 0 ] + " m / " + ftmin + "ft");
                $( "#height-end" ).html( ui.values[ 1 ] + " m / " + ftmax + "ft" );

                $( "#height-min" ).val( ui.values[ 0 ]);
                $( "#height-max" ).val( ui.values[ 1 ] );
                
               hitAjax();
                      
            }
        });  
    });
        </script>
        <?php
    }
    
    // ajax hit 
    function featchResults(){
        
     $dd = get_terms([
            'taxonomy' => 'pa_working-height-m'
        ]);
      $height_m = array();
      
      foreach($dd as $d ){
          if(number_format($d->name,2) >= map_deep( wp_unslash( $_POST['heightmin_m'] ?? '' ), 'sanitize_text_field' ) && number_format($d->name,2) <= map_deep( wp_unslash( $_POST['heightmax_m'] ?? '' ), 'sanitize_text_field' ) ){
               array_push($height_m,$d->slug);
          }
          
      }

//   ft data managment 
        $dd = get_terms([
         'taxonomy' => 'pa_working-height-ft'
        ]);
        
        $height_ft = array();
        
        foreach($dd as $d ){
            
            if(number_format($d->name,2) >= map_deep( wp_unslash( $_POST['heightmin_ft'] ?? '' ), 'sanitize_text_field' ) && number_format($d->name,2) <= map_deep( wp_unslash( $_POST['heightmax_ft'] ?? '' ), 'sanitize_text_field' ) ){
            array_push($height_ft,$d->slug);
        }
        
        }


        
         $datacat = array_filter(explode(',',map_deep( wp_unslash( $_POST['product_cat'] ?? '' ), 'sanitize_text_field' )), function($value) { return !is_null($value) && $value !== ''; });
          $year = array_filter(explode(',',map_deep( wp_unslash( $_POST['pa_year-modal'] ?? '' ), 'sanitize_text_field' )), function($value) { return !is_null($value) && $value !== ''; });
        $datapower = array_filter(explode(',',map_deep( wp_unslash( $_POST['pa_power'] ?? '' ), 'sanitize_text_field' )), function($value) { return !is_null($value) && $value !== ''; });
        $datamanufacturer = array_filter(explode(',',map_deep( wp_unslash( $_POST['pa_manufacturer'] ?? '' ), 'sanitize_text_field' )), function($value) { return !is_null($value) && $value !== ''; });
    
	          $args = array(
                            'post_type' => 'product','post_status' => array( 'publish' ), 'posts_per_page' => -1,
                        );
                    $args['tax_query'] = array( 'relation'=> 'AND' );
                    $args['meta_query'] = array( 'relation'=> 'AND' );
                      
               
                
	            if($height_ft[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_working-height-ft',
                            'field'    => 'slug',
                            'terms'    => $height_ft,
                            
                        ));	            
    	        }
    	        
    	         if($height_m[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_working-height-m',
                            'field'    => 'slug',
                            'terms'    => $height_m,
                            
                        ));	            
    	        }
    	        
    	         if($datacat[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'term_id',
                            'terms'    => $datacat,
                            
                        ));	            
    	        }
    	        
    	        if($year[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_model-year',
                            'field'    => 'slug',
                            'terms'    => $year,
                            
                        ));	            
    	        }
    	        
    	        if($datapower[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_power',
                            'field'    => 'term_id',
                            'terms'    => $datapower,
                            
                        ));	            
    	        }
    	        if($datamanufacturer[0] != ''){
	            
    	          array_push($args['tax_query'] , array(
                            'taxonomy' => 'pa_manufacturer',
                            'field'    => 'term_id',
                            'terms'    => $datamanufacturer,
                            
                        ));	            
    	        }
    	        $index_query = new WP_Query($args);
    	        
    	        ob_start();
    	        while ($index_query->have_posts()) : $index_query->the_post();
    	        
    	            wc_get_template_part( 'pro', 'grid' );
		        	wc_get_template_part( 'pro', 'list' );
		        	
            	endwhile; wp_reset_postdata();
            	
                $html = ob_get_clean();
                echo $html;
                die;

            
    }

}
$obj = new WwooxommersFilters();