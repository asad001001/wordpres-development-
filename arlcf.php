<?php
   /**
    * template name: non-profit-search
    *
    * This is the template that displays all pages by default.
    * Please note that this is the WordPress construct of pages and that
    * other "pages" on your WordPress site will use a different template.
    *
    * @package WordPress
    * @subpackage Twenty_Fifteen
    * @since Twenty Fifteen 1.0
    */
   
   get_header(); ?>

<style>
div#right_block {
    order: 2;
    min-width: 0;
    transition: .3s ease all;
    position: relative;
    background-color: #FFF;
    display: table-cell;
    vertical-align: top;
    padding: 5px 10px;
    display: none;
}
.nonprofits.inner-page {
    padding: 15px 20px;
}
.col-xs-12.col-sm-4.px-2_s {
    padding: 0 11px;
    /* height: 100%; */
    float: unset;
    display: flex;
    align-content: stretch;
}
div#left_side_data {
    order: 1;
   
    transition: .3s ease all;
}
div#left_side_data.active{
 display: table-cell; 
     width: calc(100% - 370px);
}
div#search-results {
    display: flex;
    flex-wrap: wrap;
}
div#filterIcon {
  float: unset;
    padding: 6px 14px;
    margin-top: 16px;
    background: #fff;
    margin-right: 10px;
    border-radius: 5px;
    cursor: pointer;
    width: 160px;
    margin: 11px auto -30px auto;
}
div#right_block.active {
    display: table-cell;
}

i#refineArrow {
    position: absolute;
    top: 24px;
    left: 17px;
    font-size: 20px;
    font-weight: 900;
    line-height: 20px;
    cursor: pointer;
    color: #f37323 ;
}

h3#refineText {
    font-size: 16px;
    font-weight: 900;
    line-height: 140%;
    color: #002D41;
    margin-top: 24px;
    margin-bottom: 32px;
    background: none;
    text-align: center;
}

.sideNav-item.alphabetSearch.advAlphabetical {
    width: 288px;
    border: 1px solid #C0C8D7;
    border-radius: 4px;
    background-color: #FFF;
    margin-bottom: 16px;
    max-width: 288px;
    padding: 15px 0 0 5px;
    margin: 5px auto 5px auto;
}

label.advTitle {
    font-size: 13px;
    font-weight: 400;
    line-height: 16px;
    color: #54698D;
    padding-left: 11px;
}

a.cursor-pointer.page__list-item.page__list-item--current {
    display: block;
    padding: 6px 12px;
    width: 79px;
    height: 32px;
    border-radius: 4px;
    font-family: Roboto;
    font-size: 14px;
    font-weight: 500;
    line-height: 20px;
    color: #FFF;
    background-color: #f37323;
    margin: 0 auto;
}
.dropdown-content {
    min-width: 270px;
    height: 290px;
}
select#category-select{
    display:none;
    }
    
button.dropbtn {
    background-color: #aeaeae !important;
    height: 36px;
    padding: 4px 7px;
    width: 270px;
    text-align: left;
}
div#myDropdown a {
    text-align: left;
    padding: 5px 10px;
}
a.sub_cate {
    padding-left: 20px !important;
}


a.more_sub_cate {
    padding-left: 30px !important;
}
.letterContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    max-width: 100%;
    margin: 0 37px 16px 37px;
    padding: 0;
    /* justify-content: left; */
}

a.cursor-pointer.page__list-item {
    width: 31px;
    height: 31px;
    padding: 4px;
    font-weight: 400;
    text-align: center;
    line-height: 25px;
    text-align: center;
    color: #333333;
    text-decoration: none;
    cursor: pointer;
}

a.cursor-pointer.page__list-item:hover {
    background-color: #999999;
    color: #DDDDDD;
    text-decoration: none;
}
.alpha_data {
    padding: 0 33px;
}
/* select#organizations\$county_Select_Advanced {
    width: 290px;
    padding: 7px 5px;
    margin-bottom: 10px;
    outline: none;
    color: gray;
}

select#organizations\$budgetSize_Select_Advanced {
    width: 290px;
    padding: 7px 5px;
    margin-bottom: 10px;
    outline: none;
    color: gray;
} */

.advSelect {
    width: 290px;
    padding: 7px 5px;
    margin-bottom: 10px;
    outline: none;
    color: gray;
}

.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 999999;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

button#clearFilters {
    width: 288px;
    margin: 10px 0 32px 0;
    border: 1px solid #f37323;
    border-radius: 4px;
    background-color: #FFF;
    color: #f37323 !important;
    height: 44px;
    font-family: Roboto;
    font-weight: 500;
    font-size: 18px;
    line-height: 28px;
    display: block;
    margin: 10px auto 0 auto;
}


    @media (max-width: 1024px){
        
        div#left_side_data.active .col-xs-12.col-sm-4.px-2_s {
        width: 50%;
        }
        select#category-select {
            width: 160px;
        }
        span.select2-selection.select2-selection--single {
            height: 38px;
            background: #aeaeae;
            border: none;
            border-radius: 0px;
            padding: 5px 0;
    text-align: left;
        }
        span#select2-category-select-container {
                color: #fff;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow{
                    top: 6px !important;
                    }
        span.select2-selection__arrow b {
            border-color: #fff transparent transparent transparent !important;
        }
    }
    
    @media (max-width: 768px){
        

        form#nonprofits-search {
            flex-wrap: wrap;
            gap: 7px;
        }
        div#left_side_data.active input#non-profits-search {
            width: 90%;
        }
        .advSelect {
            width: 215px;
        }
        div#navColumn {
            width: 250px !important;
        }
        div#right_block.active {
            display: table-cell;
            width: 215px !important;
            max-width: 250px;
        }
        button#clearFilters {
    width: 215px;
}
div#left_side_data.active .col-xs-12.col-sm-4.px-2_s {
    width: 100%;
}
.col-xs-12.col-sm-4.px-2_s {
    width: 50%;
}

}

@media (max-width: 767px){
    form#nonprofits-search, input#non-profits-search {
    width: 100%;
    padding: 0 20px;
}

.col-xs-12.col-sm-4.px-2_s {
    width: 100%;
}
div#right_block.active {
    display: block;
    width: 100% !important;
    max-width: 100%;
}
div#left_side_data.active {
    display: table-cell;
    width: calc(100% - 370px);
    display: none;
}

div#navColumn {
    width: 100% !important;
}
.advSelect {
    width: 97%;
    margin-left: 10px;
    margin-right: 19px;
}


    }

</style>

<section class="page_title">
   <div class="page_title_in">
      <div class="container">
         <div class="row">
            <h1><span><?php the_title(); ?></span></h1>
         </div>
      </div>
   </div>
</section>
<div class="nonprofits inner-page">
   <div class="container_">
      <div class="row">
         <div id="left_side_data" class="col-md-12">
            <div class="search-filters" >
               <form class="example" action="/" id="nonprofits-search">
                  <input type="text" id="non-profits-search" placeholder="Search by Name" name="search2">
                  <div class="select-filter">
                  
                 <?php 
                 
                 $taxonomies = get_terms( array(
                	'taxonomy' => 'category',
                	'hide_empty' => false
                ) );

                if ( !empty($taxonomies) ) :
                	$output = '<select id="category-select">';
                	foreach( $taxonomies as $category ) {
                		if( $category->parent == 0 ) {
                			$output.= '<option value="'. esc_attr( $category->slug ) .'">
                					'. esc_html( $category->name ) .'</option>';
                			foreach( $taxonomies as $subcategory ) {
                				if($subcategory->parent == $category->term_id) {
                				$output.= '<option class="sub_cate" value="'. esc_attr( $subcategory->slug ) .'">
                					'. esc_html( $subcategory->name ) .'</option>';
                					
                						foreach( $taxonomies as $moresubcategory ) {
                        				if($moresubcategory->parent == $subcategory->term_id) {
                        				$output.= '<option class="more_sub_cate" value="'. esc_attr( $moresubcategory->slug ) .'">
                        					'. esc_html( $moresubcategory->name ) .'</option>';
                        				}
                        			}
                				}
                			}
                			
                		}
                	}
                	$output.='</select>';
                	echo $output;
                endif;
                
                      $taxonomies = get_terms( array(
                	'taxonomy' => 'category',
                	'hide_empty' => false
                ) );

           
                 ?>
                 
                 <div class="dropdown">
                 
                  <button  class="dropbtn"><?php if ( !empty($taxonomies) ) {
                	foreach( $taxonomies as $category ) {
                		if( $category->parent == 0 ) {
                		    echo  $category->name; 
                		    }
                		    }
                		    }
                		    ?></button>
                 <?php 
                 
           
                if ( !empty($taxonomies) ) :
                	$output = '<div id="myDropdown" class="dropdown-content">';
                	foreach( $taxonomies as $category ) {
                		if( $category->parent == 0 ) {
                		    $ss = $category->name;
                			$output.= '<a class="main selected" data-val="'. esc_attr( $category->slug ) .'">
                					'. esc_html( $category->name ) .'</a>';
                			foreach( $taxonomies as $subcategory ) {
                				if($subcategory->parent == $category->term_id) {
                				$output.= '<a class="sub_cate" data-val="'. esc_attr( $subcategory->slug ) .'">
                					'. esc_html( $subcategory->name ) .'</a>';
                					
                						foreach( $taxonomies as $moresubcategory ) {
                        				if($moresubcategory->parent == $subcategory->term_id) {
                        				$output.= '<a class="more_sub_cate" data-val="'. esc_attr( $moresubcategory->slug ) .'">
                        					'. esc_html( $moresubcategory->name ) .'</a>';
                        				}
                        			}
                				}
                			}
                			
                		}
                	}
                	$output.='</div>
                	</div>';
                	echo $output;
                endif;
                 ?>
                 
                
                     <?php
                        // $args = array(
                        //     'hide_empty' => false,
                        //     'orderby' => 'name',
                        //     'order' => 'ASC'
                        // );
                        // $categories = get_categories($args);
                        // echo '<select id="category-select">';
                        // foreach($categories as $category) {
                        //     echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        // }
                        // echo '</select>';
                        
                        ?>
                     <button type="submit" id="non-profits-submit"><i class="fa fa-search"></i></button>
                  </div>
               </form>
               <div class="filter_options_btn">
                  <div id="filterIcon" class="filterToggle">
                    <div><i class="fa fa-sliders"></i>  Filter Results</div>
                  </div>
               </div>
            </div>
            <div class="nonprofits_in" id="search-results">
               <?
                  $args = array(
                            'post_type' => 'nonprofit',
                            'category__in' => wp_get_post_categories( get_the_ID() ),
                            'post_status' => 'publish'
                        );
                  
                  $query = new WP_Query( $args );
                  
                  if ( $query->have_posts() ) {
                      while ( $query->have_posts() ) {
                  $query->the_post();
                  // display post content
                  ?>
               <div class="col-xs-12 col-sm-4 px-2_s">
                  <div class="nonprofits_list search-nonprofits-div">
                     <div class="post_custom_tumb">
                        <?php the_post_thumbnail('full'); ?>
                        <div class="overlay_btn">
                           <a href="<?php  echo esc_url( get_permalink()); ?>">Learn More</a>
                        </div>
                     </div>
                     <div class="costom_post_content">
                        <h2><?php the_title(); ?></h2>
                        <h3>
                           <?php 
                              $categories = get_the_category();
                              if ( ! empty( $categories ) ) {
                                  $category = esc_html( $categories[0]->name );
                                  echo '' . $category;
                              }?>
                        </h3>
                        <?php the_excerpt(); ?>
                        <p><span class="read_more"><a href="<?php  echo esc_url( get_permalink()); ?>">Learn More</a></span></p>
                     </div>
                  </div>
               </div>
               <?php
                  }
                  }
                  
                  wp_reset_postdata();
                  
                  ?>
            </div>
         </div>
         <!-- left_block -->
         <div id="right_block" class="col-md-3">
            <div id="navColumn" class="navColumn-main" style="width: 356px;">
               <div class="filters">
                  <i id="refineArrow" class="fa fa-arrow-right"></i>
                  <h3 id="refineText">Refine Results</h3>
                  <!-- <div class="alpha_data"><label for="organizations$organizationName_calc_Select_Advanced" class="advTitle">Organization Name</label>
                  <div style="justify-content: center;">
                     <div class="sideNav-item alphabetSearch advAlphabetical" aria-labelledby="labelFor_organizations$organizationName_calc">
                        <span><a filterval="-1" class="cursor-pointer page__list-item page__list-item--current">Show All</a></span><br>
                        <div class="letterContainer"><a class="cursor-pointer page__list-item" filterval="0">#</a><a class="cursor-pointer page__list-item" filterval="1">A</a><a class="cursor-pointer page__list-item" filterval="2">B</a><a class="cursor-pointer page__list-item" filterval="3">C</a><a class="cursor-pointer page__list-item" filterval="4">D</a><a class="cursor-pointer page__list-item" filterval="5">E</a><a class="cursor-pointer page__list-item" filterval="6">F</a><a class="cursor-pointer page__list-item" filterval="7">G</a><a class="cursor-pointer page__list-item" filterval="8">H</a><a class="cursor-pointer page__list-item" filterval="9">I</a><a class="cursor-pointer page__list-item" filterval="10">J</a><a class="cursor-pointer page__list-item" filterval="11">K</a><a class="cursor-pointer page__list-item" filterval="12">L</a><a class="cursor-pointer page__list-item" filterval="13">M</a><a class="cursor-pointer page__list-item" filterval="14">N</a><a class="cursor-pointer page__list-item" filterval="15">O</a><a class="cursor-pointer page__list-item" filterval="16">P</a><a class="cursor-pointer page__list-item" filterval="17">Q</a><a class="cursor-pointer page__list-item" filterval="18">R</a><a class="cursor-pointer page__list-item" filterval="19">S</a><a class="cursor-pointer page__list-item" filterval="20">T</a><a class="cursor-pointer page__list-item" filterval="21">U</a><a class="cursor-pointer page__list-item" filterval="22">V</a><a class="cursor-pointer page__list-item" filterval="23">W</a><a class="cursor-pointer page__list-item" filterval="24">X</a><a class="cursor-pointer page__list-item" filterval="25">Y</a><a class="cursor-pointer page__list-item" filterval="26">Z</a></div>
                     </div> 
                  </div>
                </div> -->
               </div>
            </div>
        
        <?php     $terms = get_terms( array(
                'taxonomy' => 'population-served',
                'hide_empty' => false,
            ) );
        ?>

            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Population Served</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true"  class="advSelect" name="population_served" id="population_served" aria-label="population Served">
                        <option value="">Please Select</option>
                        <?php foreach($terms as $item){ ?>
                        <option value="<?php echo $item->slug; ?>"><?php echo $item->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
             <?php     $terms = get_terms( array(
                'taxonomy' => 'type-of-work',
                'hide_empty' => false,
            ) );
        ?>

            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Type of Work</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true"  class="advSelect" name="type_of_work" id="type_of_work" aria-label="population Served">
                        <option value="">Please Select</option>
                        <?php foreach($terms as $item){ ?>
                        <option value="<?php echo $item->slug; ?>"><?php echo $item->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
             <?php     $terms = get_terms( array(
                'taxonomy' => 'population-scope',
                'hide_empty' => false,
            ) );
        ?>

            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Population Scope</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true"  class="advSelect" name="population_scope" id="population_scope" aria-label="population scope">
                        <option value="">Please Select</option>
                        <?php foreach($terms as $item){ ?>
                        <option value="<?php echo $item->slug; ?>"><?php echo $item->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            
            
             <?php     $terms = get_terms( array(
                'taxonomy' => 'organization-leadership',
                'hide_empty' => false,
            ) );
        ?>

            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Organization Leadership</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true"  class="advSelect" name="organization_leadership" id="organization_leadership" aria-label="population Served">
                        <option value="">Please Select</option>
                        <?php foreach($terms as $item){ ?>
                        <option value="<?php echo $item->slug; ?>"><?php echo $item->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
             <?php     $terms = get_terms( array(
                'taxonomy' => 'budget-size',
                'hide_empty' => false,
            ) );
        ?>

            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Budget Size</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true"  class="advSelect" name="budget_size" id="budget_size" aria-label="population Served">
                        <option value="">Please Select</option>
                        <?php foreach($terms as $item){ ?>
                        <option value="<?php echo $item->slug; ?>"><?php echo $item->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            <div advancedfilter="true" filternumber="2" class="sideNav-item">
               <div>
                  <label for="organizations$county_Select_Advanced" class="advTitle">Black Led</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true" filternumber="2" class="advSelect" name="black_led" id="black_led" aria-label="Black Led">
                        <option value="">Show All</option>
                        <option value="black-led">Yes</option>
                     </select>
                  </div>
               </div>
            </div>
            <div advancedfilter="true" filternumber="3" class="sideNav-item">
               <div>
                  <label for="organizations$budgetSize_Select_Advanced" class="advTitle">LGBTQ Led</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true" filternumber="3" class="advSelect" name="LGBTQ_led" id="LGBTQ_led" aria-label="LGBTQ Led">
                        <option value="">Show All</option>
                        <option value="lgbtq-led">Yes</option>
                       
                     </select>
                  </div>
               </div>
            </div>
            <div advancedfilter="true" filternumber="6" class="sideNav-item">
               <div>
                  <label for="organizations$blackLedBlackBenefiting_Select_Advanced" class="advTitle">Women Led</label>
                  <div style="text-align: center;">
                     <select advancedfilter="true" filternumber="6" class="advSelect" name="women_led" id="women_led" aria-label="Women Led">
                        <option value="">Show All</option>
                        <option value="women-led">Yes</option>
                     </select>
                  </div>
               </div>
            </div>
            <button id="clearFilters">Clear Filters</button>
         </div>
      </div>
   </div>
</div>
<!-- row  -->
</div>
<!-- container -->
</div>
<?php get_footer(); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
jQuery(document).ready(function(){
  jQuery("div#filterIcon,i#refineArrow").on('click',function(e){

  e.preventDefault();
  jQuery('div#right_block').toggleClass('active');
  jQuery('div#left_side_data').toggleClass('active');
});
  
});

</script>
