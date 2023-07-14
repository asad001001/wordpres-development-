<?php
//Child Theme Functions File
add_action( "wp_enqueue_scripts", "enqueue_wp_child_theme" );
function enqueue_wp_child_theme() 
{
    if((esc_attr(get_option("childthemewpdotcom_setting_x")) != "Yes")) 
    {
		//This is your parent stylesheet you can choose to include or exclude this by going to your Child Theme Settings under the "Settings" in your WP Dashboard
		wp_enqueue_style("parent-css", get_template_directory_uri()."/style.css" );
    }

	//This is your child theme stylesheet = style.css
	wp_enqueue_style("child-css", get_stylesheet_uri());

	//This is your child theme js file = js/script.js
	wp_enqueue_script("child-js", get_stylesheet_directory_uri() . "/js/script.js", array( "jquery" ), "1.0", true );
}
 

// ChildThemeWP.com Settings 
function childthemewpdotcom_register_settings() 
{ 
	register_setting( "childthemewpdotcom_theme_options_group", "childthemewpdotcom_setting_x", "ctwp_callback" );
}
add_action( "admin_init", "childthemewpdotcom_register_settings" );

//ChildThemeWP.com Options Page
function childthemewpdotcom_register_options_page() 
{
	add_options_page("Child Theme Settings", "My Child Theme", "manage_options", "childthemewpdotcom", "childthemewpdotcom_theme_options_page");
}
add_action("admin_menu", "childthemewpdotcom_register_options_page");

//ChildThemeWP.com Options Form
function childthemewpdotcom_theme_options_page()
{ 
?>
<div>
	<style>
		table.childthemewpdotcom {table-layout: fixed ;  width: 100%; vertical-align:top; }
		table.childthemewpdotcom td { width:50%; vertical-align:top; padding:0px 20px; }
		#childthemewpdotcom_settings { padding:0px 20px; }
	</style> 
	<div id="childthemewpdotcom_settings">
		<h1>Child Theme Options</h1>
	</div>
	<table class="childthemewpdotcom">
		<tr>
			<td>
                <form method="post" action="options.php">
                	<h2>Parent Theme Stylesheet Include or Exclude</h2>
                	<?php settings_fields( "childthemewpdotcom_theme_options_group" ); ?>
					<p><label><input size="76" type="checkbox" name="childthemewpdotcom_setting_x" id="childthemewpdotcom_setting_x"
					<?php if((esc_attr(get_option("childthemewpdotcom_setting_x")) == "Yes")) {   echo " checked='checked' ";  }  ?>
					value="Yes" > 
					TICK To DISABLE The Parent Stylesheet style.css In Your Site HTML<br><br>
                    ONLY TICK This Box If When You Inspect Your Source Code It Contains Your Parent Stylesheet style.css Two Times. Ticking This Box Will Only Include It Once.</label></p>
					<?php submit_button(); ?>
				</form>	
			</td>
			<td>
				<h2>More From The Author</h2>
                <p><b>Would you like your website speed to be faster?</b> I used WP Engine to build one of the fastest WordPress websites in the World <a href="https://shareasale.com/r.cfm?b=779590&u=1897845&m=41388&urllink=&afftrack=">WP Engine - Get 3 months free on annual plans</a> [affiliate link]</p>
				<p><b>Find out about how I built one fo the fastest WordPress websites in the World</b> <a href="https://www.wpspeedupoptimisation.com?ref=ChildThemeWP" target="_blank">I followed these steps</a></p>
			</td>
		</tr>
	</table>
</div>
<?php
} 

//Footer Link
function childthemewpdotcom_footerlink() 
{  
	if((is_home()) || (is_front_page()))
	{
	?>
		<div id="footerlinktochildthemewp" style="text-align:center;"><p><a href="https://childthemewp.com" target="_blank" style="font-size:10px;">child theme wp</a></p></div>
		<?php
	}
}
add_action("wp_footer", "childthemewpdotcom_footerlink");

if( function_exists('acf_add_options_page') ) {
 	// add parent
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'Theme Settings',
		'redirect' 		=> false
	));
	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'College List Settings',
		'menu_title' 	=> 'College List',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}

/////////////////////////////////////////////////////////////

function character_list_shortcode() {
    ob_start(); // Start output buffering

    if (have_rows('character', 'option')) :
        ?>
       
            <ul class="result_college_filter_list">
                <li class="result_college_filter_all result_college_filter_name js-filter" data-char="all">ALL</li>
                 <?php while (have_rows('character', 'option')) : the_row(); ?>
                    <li class="result_college_filter_name js-filter" data-char="<?php the_sub_field('character_name', 'option'); ?>"><?php the_sub_field('character_name', 'option'); ?></li>
                <?php endwhile; ?> 
            </ul>   
        <div class="results_list_grid_wrap">
            <?php while (have_rows('character', 'option')) : the_row(); ?>
				<?php	$get_char_field =  get_sub_field('character_name', 'option'); ?>
				<div  class="test js-filterable" data-char-name="<?php echo $get_char_field[0]; ?>">
					<div class="result_charc_name">
					<?php the_sub_field('character_name', 'option'); ?>
					</div>
					<ul class="result_college_list">
						<?php while (have_rows('college_character_list', 'option')) : the_row(); ?>
							<li class="result_college_name">
								<?php the_sub_field('college_name', 'option'); ?>
							</li>
						<?php endwhile; ?>
					</ul>
				
				</div>
            <?php endwhile; ?>
        </div>
        <?php
    endif;

    return ob_get_clean(); // Return the shortcode output
}
add_shortcode('character_list', 'character_list_shortcode');



//asad code
function enqueue_ajax_scripts() {
    wp_enqueue_script( 'ajax-category-search', get_stylesheet_directory_uri() . '/js/hashe.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'ajax-category-search', 'ajax_category_search', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'enqueue_ajax_scripts' );

add_action('wp_ajax_filter_posts_cate', 'filter_posts_cate');
add_action('wp_ajax_nopriv_filter_posts_cate', 'filter_posts_cate');

function filter_posts_cate() {
  $category = $_POST['category'];

  $search = $_POST['search'];

  

  $args = array('post_type' => 'team-member','orderby'=> 'title', 'order' => 'ASC');
  $args['tax_query'] = array( 'relation'=> 'AND' );
  
  if($category != ''){
	
	array_push($args['tax_query'] , array (
		'taxonomy' => 'type-of-employee',
		'field' => 'slug',
		'terms' => $category,
	));	 
     
    }

    
    if($search != ''){
        
        $args['s'] = $search;
        
        }
        
    // print_r($args);
  $query = new WP_Query($args);
  
$item=1;

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // display post content
        ?>
              
            <!--item start-->
            <div class="result_item <?php echo (($item <= 9 )? "show": "hide"); ?>" data-item="<?php echo $item++; ?>">
                <div class="img_link">
                    <a href="<?php  echo esc_url( get_permalink()); ?>">
                       <?php the_post_thumbnail('full'); ?>
                    </a>
                </div>
                <div class="name_link">
                    <a href="<?php  echo esc_url( get_permalink()); ?>">
                        <span class="text-icon_right"><i aria-hidden="true" class="far fa-arrow-alt-circle-right"></i></span>
                        <span class="elementor-button-text"><?php the_title(); ?></span>
                    </a>
                </div>
            </div>
            <!--item end-->
        <?php
    }
    echo "<input type='hidden' value='".($item-1)."' id='total_items_hidden' data-showing='9'>";
}
else{
	//This Statement stores data in variable
 $test = '<h3 id ="no-result" >No Post Available</h3>'; 
 //this is for printing variable that contains data
 echo $test;
}
wp_reset_postdata();
    die();

}


add_shortcode('side_bar_accordian','side_bar_accordian');

function side_bar_accordian () {

?>

      <ul class="sidebar_accord">
            <li id="item_1">
                  <?php $term = get_term_by( 'id', 25, 'type-of-employee' ); ?>
             <span class="accordian_head" data-val="<?php echo $term->slug; ?>" data-val-name="<?php echo $term->name; ?>">
               
                <a href="#" >Education Advising Team <i class="far fa-angle-double-down" style="font-family:fontawesome;"></i></a>  </span>
                <div class="accod_body">
                    <ul class="action_items">
                        
                             <?php 
                    
                    $term_id = 25;
                    $taxonomy_name = 'type-of-employee';
                    $termchildren = get_term_children( $term_id, $taxonomy_name );
                    foreach ($termchildren as $item){
                        	$term = get_term_by( 'id', $item, $taxonomy_name );

                        ?>
                        <li  data-val="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
            </li>
            <li id="item_2">
                <?php $term = get_term_by( 'id', 31, 'type-of-employee' ); ?>
             <span class="accordian_head" data-val="<?php echo $term->slug; ?>" data-val-name="<?php echo $term->name; ?>">
                 
                  <a href="#"  >Tutoring Team <i class="far fa-angle-double-down" style="font-family:fontawesome;"></i></a>  </span>
                <div class="accod_body">
                    <ul class="action_items">
                        
                             <?php 
                    
                    $term_id = 31;
                    $taxonomy_name = 'type-of-employee';
                    $termchildren = get_term_children( $term_id, $taxonomy_name );
                    foreach ($termchildren as $item){
                        	$term = get_term_by( 'id', $item, $taxonomy_name );

                        ?>
                        <li  data-val="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
            </li>
            <li >

                <a href="#" data-val="client-support-operations" class="no_filter" >Client Support & Operations</a>
            </li>
        </ul>

<?php
}

add_shortcode('search_filters','search_filters');

function search_filters (){
    
    
    
$term_id = 25;
$taxonomy_name = 'type-of-employee';
$termchildren = get_term_children( $term_id, $taxonomy_name );

    
    ?>
        
<div class="filters_container_all">
    
    <div class="top_fields_container">
        <ul>
            <li class="search_name_field"><input placeholder="Search Team by Name" name="search" class="input_text_search" type="text" value="" title=""></li>
            <li class="search_select_field">
                <select name="select_employee" class="select_employee" title="Type of employee">
                    <option  value="">Type of employee</option>
                    <?php 
                    $term = get_term_by( 'id', 25, $taxonomy_name );
                    ?>
                    <!--<option  value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>-->
                    <?php
                    $term_id = 25;
                    $taxonomy_name = 'type-of-employee';
                    $termchildren = get_term_children( $term_id, $taxonomy_name );
                    foreach ($termchildren as $item){
                        	$term = get_term_by( 'id', $item, $taxonomy_name );

                        ?>
                        <!--option  value="<?php //echo $term->slug; ?>"><?php //echo $term->name; ?></option-->
                        <?php
                    }
                    ?>
					</select>
            </li>
        </ul>
    </div>
    <!-- records -->
    
        <div  class="results_container" id="result_items">
            
            
               <?
	 			
                  $args = array(
                            'post_type' => 'team-member',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'title',
                            'order' => 'ASC',
                            
                            
                        );
                  $item = 1;
                  $query = new WP_Query( $args );
                  
                  if ( $query->have_posts() ) {
                      while ( $query->have_posts() ) {
                  $query->the_post();
                  // display post content
                  ?>
                  
            <!--item start-->
            <div class="result_item <?php echo (($item <= 9 )? "show": "hide"); ?>" data-item="<?php echo $item++; ?>">
                <div class="img_link">
                    <a href="<?php  echo esc_url( get_permalink()); ?>">
                       <?php the_post_thumbnail('full'); ?>
                    </a>
                </div>
                <div class="name_link">
                    <a href="<?php  echo esc_url( get_permalink()); ?>">						
                        <span class="elementor-button-text"><?php the_title(); ?></span>
						
                        <span class="text-icon_right"><i aria-hidden="true" class="far fa-arrow-alt-circle-right"></i></span>
                    </a>
                </div>
            </div>
            <!--item end-->
              <?php
                  }
                  }
                  
                  wp_reset_postdata();
                  
                  ?>
        </div>
        <div class="filters_load_btn" data-total="<?php echo $item; ?>" data-showing="9" > <button class="btn_load">Load More</button></div>
</div>        

<?php
}


//////////////////////////////////////////////

function display_custom_post_categories() {
    // Get the current post ID
    $post_id = get_the_ID();

    // Get the categories assigned to the current post
    $categories = get_the_terms($post_id, 'type-of-employee');

    if (!empty($categories)) {
        echo '<ul class="marks_sub_child_cat_list">';
        foreach ($categories as $category) {
            if ($category->parent !== 0) {
                echo '<li>' . $category->name . '</li>';
            }
        }
        echo '</ul>';
    }
}
function custom_post_categories_shortcode() {
    ob_start();
    display_custom_post_categories();
    return ob_get_clean();
}
add_shortcode('custom_post_categories', 'custom_post_categories_shortcode');
