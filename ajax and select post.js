jQuery(document).ready(function($){
    
    
    
    //setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 2000;  //time in ms, 5 seconds for example
var $input = $('.input_text_search');

//on keyup, start the countdown
$input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
  
  
                  var category = jQuery(this).val();
                    var search  = $('.input_text_search').val();
        
                    console.log(category);
            
                    $.ajax({
                        type: 'POST',
                        url: ajax_category_search.ajax_url,
                        data: {
                            action: 'filter_posts_cate',
                            category: category,
                            search : search,
                        },
                        success: function(response) {
                            $('.results_container').html(response);
                              setTimeout(function(){
                        let total = jQuery(document).find('#total_items_hidden').val();
                        let showing = jQuery(document).find('#total_items_hidden').data('showing');
                          jQuery('.filters_load_btn').data('showing',showing);
                            jQuery('.filters_load_btn').data('total',total);
                            if(total > 9){
                                jQuery(".btn_load").show();
                            }else{
                                jQuery(".btn_load").hide();
                            }
                        
                    },1000);
                        }
                    }); 
  
}
    
     jQuery(".select_employee").on('change',function(e){
          e.preventDefault();
         if( $(e.target).is("select")){
                var category = jQuery(this).val();
                    var search  = $('.input_text_search').val();
        
                    console.log(category);
            
                    $.ajax({
                        type: 'POST',
                        url: ajax_category_search.ajax_url,
                        data: {
                            action: 'filter_posts_cate',
                            category: category,
                            search : search,
                        },
                        success: function(response) {
                            $('.results_container').html(response);
                              setTimeout(function(){
                        let total = jQuery(document).find('#total_items_hidden').val();
                        let showing = jQuery(document).find('#total_items_hidden').data('showing');
                          jQuery('.filters_load_btn').data('showing',showing);
                            jQuery('.filters_load_btn').data('total',total);
                            if(total > 9){
                                jQuery(".btn_load").show();
                            }else{
                                jQuery(".btn_load").hide();
                            }
                        
                    },1000);
                        }
                    }); 
     
         }
         });



     jQuery(".no_filter").on('click',function(e){
          e.preventDefault();
        
                var category = jQuery(this).data('val');
                    var search  = $('.input_text_search').val();
        
                    console.log(category);
            
                    $.ajax({
                        type: 'POST',
                        url: ajax_category_search.ajax_url,
                        data: {
                            action: 'filter_posts_cate',
                            category: category,
                            search : search,
                        },
                        success: function(response) {
                            $('.results_container').html(response);
                              setTimeout(function(){
                        let total = jQuery(document).find('#total_items_hidden').val();
                        let showing = jQuery(document).find('#total_items_hidden').data('showing');
                          jQuery('.filters_load_btn').data('showing',showing);
                            jQuery('.filters_load_btn').data('total',total);
                            if(total > 9){
                                jQuery(".btn_load").show();
                            }else{
                                jQuery(".btn_load").hide();
                            }
                        
                    },1000);
                        }
                    }); 
     
         
         });

    
    
    jQuery(".accordian_head").on('click',function (e) {
        
     e.preventDefault();
     
     if(jQuery(this).parent('li').hasClass('active')){
          jQuery(this).parent('li').toggleClass("active").siblings().removeClass('active');
          return
         
     }
     
        var category = jQuery(this).data('val');
        var categoryname = jQuery(this).data('val-name');
        
        jQuery(".select_employee").html('<option value="">Type of employee</option>');
        // jQuery(".select_employee").append('<option value="'+category+'">'+categoryname+'</option>');
        jQuery(this).parent('li').find('li').each(function(){
            
            jQuery(".select_employee").append('<option value="'+jQuery(this).data('val')+'">'+jQuery(this).text()+'</option>');
            
        });
        
        
        $('.select_employee option[value="'+category+'"]').prop('selected', true);
        
        jQuery(this).parent('li').toggleClass("active").siblings().removeClass('active');;
        
            var search  = $('.input_text_search').val();
            
            $.ajax({
                type: 'POST',
                url: ajax_category_search.ajax_url,
                data: {
                    action: 'filter_posts_cate',
                    category: category,
                    search : search,
                },
                success: function(response) {
                    $('.results_container').html(response);
                      setTimeout(function(){
                        let total = jQuery(document).find('#total_items_hidden').val();
                        let showing = jQuery(document).find('#total_items_hidden').data('showing');
                          jQuery('.filters_load_btn').data('showing',showing);
                            jQuery('.filters_load_btn').data('total',total);
                            if(total > 9){
                                jQuery(".btn_load").show();
                            }else{
                                jQuery(".btn_load").hide();
                            }
                        
                    },1000);
                }
            });
            
    });

    jQuery(".action_items li").on('click',function (e) {
        jQuery(this).toggleClass('active_nav').siblings().removeClass('active_nav');
        
    
        
            var category = jQuery(this).data('val');
            
            $('.select_employee option[value="'+category+'"]').prop('selected', true);
            
            var search  = $('.input_text_search').val();

            console.log(category);
    
            $.ajax({
                type: 'POST',
                url: ajax_category_search.ajax_url,
                data: {
                    action: 'filter_posts_cate',
                    category: category,
                    search : search,
                },
                success: function(response) {
                    $('.results_container').html(response);
                    setTimeout(function(){
                        let total = jQuery(document).find('#total_items_hidden').val();
                        let showing = jQuery(document).find('#total_items_hidden').data('showing');
                          jQuery('.filters_load_btn').data('showing',showing);
                            jQuery('.filters_load_btn').data('total',total);
                            if(total > 9){
                                jQuery(".btn_load").show();
                            }else{
                                jQuery(".btn_load").hide();
                            }
                        
                    },1000);
                }
            });
    });
    
    
    
    jQuery(".btn_load").on("click",function (e) {
           e.preventDefault();
                let showing = jQuery(this).parent('.filters_load_btn').data('showing');
            let total = jQuery(this).parent('.filters_load_btn').data('total');
            let toshow = showing + 9;
        
            jQuery('.result_item.hide').each(function(){
                let item = jQuery(this).data('item');
                if( item <= toshow ){
                    jQuery(this).removeClass('hide');
                    jQuery(this).addClass('show');
                }
            });
            jQuery(this).parent('.filters_load_btn').data('showing',toshow);
            
            if(toshow >= total){
                
                jQuery(this).hide();
            
            }
            
        });
    
    
});
