var $ = jQuery.noConflict();

$(document).ready(function(){

  jQuery(document).on('click','.single_add_to_cart_button',function(){


    if(jQuery(document).find(".festi-cart-pop-up-body .f_c").length > 0 ){

    }else{

      jQuery(".festi-cart-pop-up-body").append('<button class="f_c">X</button>');

    }

    jQuery('body').addClass('over_hidden');
    
  });

  jQuery(document).on('click','.f_c',function(){


    jQuery('body').removeClass('over_hidden');
    jQuery(document).find('span.festi-cart-closed-button').trigger('click');


  });

  
  window.onclick = function(event) {
    if (event.target.id == 'festi-cart-pop-up-content') {
      jQuery('body').removeClass('over_hidden');
      jQuery(document).find('span.festi-cart-closed-button').trigger('click');

    }
  }

  jQuery(document).on('click',' button.continue_btn',function(){


    jQuery('body').removeClass('over_hidden');

    var ids = '';
    var data = '';           

    $(document).find(".pid_check_box").each(function() {

     var element = $(this);

     if (!element.prop('checked')) {

     }else{

       ids += element.val()+'/'+element.parents('.slide-product').find('.afterajaxdiv .variations_form.cart select').val()+"|"; 


     }


   });


    jQuery(document).find('span.festi-cart-closed-button').trigger('click');

    var data = {
      action: 'to_put_in_cart',
      id: ids,
    };
    var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!
    $.ajax({
      url: ajaxurl,
      data: data,
      type: "POST",
      success: function(e) {

        console.log(e);
        
      },
      error: function(e) {
        console.log('noajax');
      }
    });
  });   




        $('div#festi-cart-pop-up-content').click(function(e){   //try to turn off popup
         var click=$(e.target);
         var outsideDiv=$("div#festi-cart-pop-up-content");

         if(click.is(outsideDiv)){

          jQuery('body').removeClass('over_hidden');

          var ids = '';
          var data = '';         
          var checkdata = 0;

          $(document).find(".pid_check_box").each(function() {

           var element = $(this);

           if (!element.prop('checked')) {


           }else{

            ids += element.val()+'/'+element.parents('.slide-product').find('.afterajaxdiv .variations_form.cart select').val()+"|"; 
            checkdata++;            

          }


        });


          var data = {
            action: 'to_put_in_cart',
            id: ids,
          };
          if(checkdata > 0){
            if($(document).find('#my_call').length > 0){

              $(document).find('#my_call').val(1);


            }else{

              outsideDiv.append("<input type='hidden' id='my_call' value='1'>");

            }

                          var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!
                          $.ajax({
                            url: ajaxurl,
                            data: data,
                            type: "POST",
                            success: function(e) {



                              $(document.body).trigger('added_to_cart', [e.fragments, e.cart_hash,'']);
                            // location.reload();
                          },
                          error: function(e) {
                            console.log('noajax');
                          }
                        });
                        }


                      }
                    }); 





        jQuery(document).on('click','.order_btn',function(){

         jQuery('body').removeClass('over_hidden');

         var ids = '';
         var data = '';           

         $(document).find(".pid_check_box").each(function() {

           var element = $(this);

           if (!element.prop('checked')) {

           }else{

             ids += element.val()+'/'+element.parents('.slide-product').find('.afterajaxdiv .variations_form.cart select').val()+"|"; 


           }


         });



    //   console.log(ids);

    jQuery(document).find('span.festi-cart-closed-button').trigger('click');

    var data = {
      action: 'to_put_in_cart',
      id: ids,
    };
    var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!
    $.ajax({
      url: ajaxurl,
      data: data,
      type: "POST",
      success: function(e) {

        console.log(e);
        
      },
      error: function(e) {
        console.log('noajax');
      }
    });
    window.location.href = 'https://demo7.1stopwebsitesolution.com/aquarium/cart/'

  });


    //  check boxes
    jQuery(document).on('click','.for_product_check ',function(){

      if(jQuery(this).find('.pid_check_box').prop('checked')){


       jQuery(this).find('.pid_check_box').prop('checked',false);
       jQuery(this).removeClass('active');

     }else{



       jQuery(this).find('.pid_check_box').prop('checked',true);
       jQuery(this).addClass('active');



     }



   });
    
    
    
    $(document).on('click',".all_selections .search-clear-filter",function(){

      var action =  $(this).parents(".selected-filter").data('query');

      if($(this).parents('.selected-filter').hasClass('category_tag')){

        $(document).find(".pscat-form input[type='checkbox']").each(function() {
         var element = $(this);

         if (!element.prop('checked')) {

         }else{

           if(action == element.val()){
             element.trigger('click');
             console.log(element.val());
             $('.'+action).remove();
           }
         }
       });



      }else if($(this).parents('.selected-filter').hasClass('brand_tag')){
       var countTag = 0;
       $(document).find(".psbrand-form input[type='checkbox']").each(function() {
         var element = $(this);

         if (!element.prop('checked')) {

         }else{
           countTag++;
           if(action == element.val()){
             element.trigger('click');
             $('.'+action).remove();
           }

         }

       });
       if(countTag == 1){
        $('.product_card').show();
      }
      console.log(countTag);



    }else if($(this).parents('.selected-filter').hasClass('sorting_tag')){
      console.log(true);

      $(document).find(".pssorting-form input[type='checkbox']").each(function() {
       var element = $(this);

       if (!element.prop('checked')) {

       }else{

         if(action == element.val()){

           element.trigger('click');

           $(".all_selections .sorting_tag").remove(); 
         }

       }
     });

    }

     var countProductDiv = 0;
      jQuery('.product_card ').each(function(){
        if($(this).css('display') !== 'none'){
          if($(this).css('display') !== 'none'){
          countProductDiv++;
          }
        }
      });
      $('.product_count').html('Products Count : <span class="count_num"> </span> ');
      startCounter(0,countProductDiv);
      $('.product_count').show();

  });

    $('#slick1').slick({
      rows: 2,
      dots: false,
      arrows: true,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 2,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true,
          arrows: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          dots: true,
          arrows: false
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          dots: true,
          arrows: false
        }
      }
      ]
    });        

    $('.h-latest-pro-slider .products').slick({
      dots: false,
      infinite: false,
      speed: 1000,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      infinite: true,
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });

    var algen_bestrijden = [];
    var aquarium_decoratie = [];
    var aquarium_onderdelen = [];
    var aquarium_onderhoud = [];
    var aquarium_planten = [];
    var aquarium_sale = [];
    var aquarium_schoonmaken = [];
    var aquarium_vissen = [];
    var kassakoopjes = [];
    var product_bundels = [];

    //for all brands 
    var AllBrandArr = [];

    // for all producrs
    var AllProducts  = [];

    $('.h-latest-pro-slider button.slick-prev.slick-arrow, .h-latest-pro-slider button.slick-next.slick-arrow').text('');
    $('#slick1 button.slick-prev.slick-arrow, #slick1 button.slick-next.slick-arrow').text('');
// $('#text-2 input[type="submit"]').val('');
$(".h-latest-pro-slider .hover-content.wd-more-desc.woodmart-more-desc").insertAfter(".h-latest-pro-slider .wd-bottom-actions");


$('.searchform.wd-style-with-bg.search-style-with-bg input.s').focus(function(){
  $('.product_count').hide();
  AllBrandArr = [];
  AllProducts = [];
    // $('.topsearchbarpro').trigger( "click" ); 
    $.getJSON( "https://demo7.1stopwebsitesolution.com/aquarium/products_json/products.json", function( data ) {
      for(i in data){
        for(k in data[i].main_cat){
          if(data[i].main_cat[k] == 'algen-bestrijden'){
            algen_bestrijden.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-decoratie'){
            aquarium_decoratie.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-onderdelen'){
            aquarium_onderdelen.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-onderhoud'){
            aquarium_onderhoud.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-planten'){
            aquarium_planten.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-sale'){
            aquarium_sale.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-schoonmaken'){
            aquarium_schoonmaken.push(data[i]);
          }else if(data[i].main_cat[k] == 'aquarium-vissen'){
            aquarium_vissen.push(data[i]);
          }else if(data[i].main_cat[k] == 'kassakoopjes'){
            kassakoopjes.push(data[i]);
          }else if(data[i].main_cat[k] == 'product-bundels'){
            product_bundels.push(data[i]);
          }
          data[i]['searchkeyword'] = data[i].main_cat.join(", ");
        }
        AllBrandArr.push(data[i]);
        AllProducts.push(data[i]);
      }

      console.log(AllBrandArr);
    });
    $('.top_search_new_pop').addClass('active_pop');
    $("body").addClass('over_hidden');
    $("input.ps.wd-search-inited").focus();

    // $('.topsearchbx input.ps').val('');

  });





let typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 5 second for example
var $input = $('input.ps');

//on keyup, start the countdown
$input.on('keyup', function () {
  if($(this).val().length > 2){  
    $('.for_loading').show();
    clearTimeout(typingTimer);
    var searchVal = $(this).val();
    if(searchVal != ''){
      typingTimer = setTimeout(function(){
        const newArrProducts = AllProducts.filter((item) => item.name.toLowerCase().includes(searchVal.toLowerCase()));
        var HTML = '';
        for(i in newArrProducts){
         HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
        }
        if(newArrProducts == ''){ 
          const newArrProducts = AllProducts.filter(item => item.searchkeyword.toLowerCase().indexOf(searchVal) > -1);
          var HTML = '';
          for(i in newArrProducts){
           HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
          }
        }
        
      $('.product-searchbar .row').html(HTML);
      var countProductDiv = 0;
      jQuery('.product_card ').each(function(){
        if($(this).css('display') !== 'none'){
        countProductDiv++;
      }
      });
      $('.product_count').html('Products Count : <span class="count_num"> </span> ');
      startCounter(0,countProductDiv);
      $('.product_count').show(); 
       $('.for_loading').hide();
     },1000);
    }else{
      $('.product-searchbar .row').html('');
      $('.for_loading').hide();
    }
  }else{
    $('.product-searchbar .row').html('');
    $('.for_loading').hide();
  }
});


let ajax_runer =  (searchelement) => {

  var ps = searchelement.val();

  $('.price-range-slider').hide();
  $('form.pssorting-form').hide();
  $('form.psbrand-form').hide();
  $('form.pscat-form').hide();


  var catformData = '';
  $(document).find(".pscat-form input[type='checkbox']").each(function() {
    var element = $(this);
    if (!element.prop('checked')) {
    }else{
      catformData += element.val()+"|"; 
    }
  });


// get_category_by_search

var data = ajax_result_action();
data.action = 'get_category_by_search';
var data2 = {
  action: 'folder_contents',
  ps:ps,
};
    var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!
    $.ajax({
      url: ajaxurl,
      data: data,
      type: "POST",
        // dataType: "json",
        success: function(results) {
          var result_data = JSON.parse(results);
          $('.product-searchbar .row').replaceWith(result_data.post_data);
          if(ps == ''){

            $('.pscat-form .con_tain').html($(".con_tain_empy").html());
            $(".psbrand-form").html($(".psbrand-form_empty").html());
            
          }else{

            $('.pscat-form .con_tain').replaceWith(result_data.cate);
            $('.sort-topsearch form.psbrand-form').html(result_data.brands);

          }    

          get_html_data();
          // re_init_rang_slider();
          $('.for_loading').hide();

        },
        error: function(e) {
          console.log(e);
        }
      });

  }
  




$(document).on('change', ".pssorting-check",function(e) {
  var countProductDiv = 0;

  // if($(this).prop('checked')){
  //    $('.pssorting-check').each(function(){
  //     $('.pssorting-check').prop('checked', false);
  //   });
  //    $(this).prop('checked',true);
  // }

  $('.pssorting-form').css('display','none');
  var getCheckedVal = $(this).val();
  
  checkParentCheck = 0;
  checkParentArray = [];
  $('input.pscat-check').each(function(){
    if($(this).prop('checked')){
      checkParentCheck = 1;
      checkParentArray.push($(this).val());
    }
  });
  
  checkBrandCheck = 0
  checkBrandArray = [];
  $('input.psbrand-check').each(function(){
    if($(this).prop('checked')){
      checkBrandCheck = 1;
      checkBrandArray.push($(this).val());
    }
  });
  
  if($(this).prop('checked')){
     $('.pssorting-check').each(function(){
      $('.pssorting-check').prop('checked', false);
    });
     $(this).prop('checked',true);
     if(checkParentCheck == 0 && checkBrandCheck == 0 ){
    if(getCheckedVal == 'date' || getCheckedVal == 'popularity'|| getCheckedVal == 'rating' || getCheckedVal == 'lowest' || getCheckedVal == 'high'){
      $('.product-searchbar .row').html('');
      newArrProducts = [];
      $.getJSON( "https://demo7.1stopwebsitesolution.com/aquarium/products_json/products.json", function( data ) {
          for(i in data){
            newArrProducts.push(data[i]);
          }
          if(getCheckedVal == 'lowest'){
            newArrProducts.sort(function(a, b){return a.price - b.price});
            
          }else if(getCheckedVal == 'high'){
             newArrProducts.sort(function(a, b){return b.price - a.price});
          }else if(getCheckedVal == 'popularity'){
            newArrProducts.sort(function(a, b){return b.sold - a.sold});
          }else if(getCheckedVal == 'rating'){
            newArrProducts.sort(function(a, b){return b.rating - a.rating});
          }
          var countTotalProducts = newArrProducts.length;
          var HTML = '';
          if(getCheckedVal == 'sorting'){
            for ( var i = 70 ; i >= 20 ; i--){
            HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
            }
          }else if(getCheckedVal == 'sale'){
            for ( var i = 70 ; i >= 40 ; i--){
            HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
            }
          }else if(getCheckedVal == 'lowest' || getCheckedVal == 'high' || getCheckedVal == 'popularity' || getCheckedVal == 'rating'){
            for ( var i = 0 ; i <= 70 ; i++){
            HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
            }
          }else{
            for ( var i = 70 ; i >= 0 ; i--){
            HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
            }
          }
          
          $('.product-searchbar .row').append(HTML);
            var countProductDiv = 0;
              jQuery('.product_card ').each(function(){
                if($(this).css('display') !== 'none'){
                countProductDiv++;
              }
              });
              $('.product_count').html('Products Count : <span class="count_num"> </span> ');
              startCounter(0,countProductDiv);
              $('.product_count').show(); 
          $('.for_loading').hide();
          setTimeout(function(){
            HTML = '';
            if(getCheckedVal == 'lowest' || getCheckedVal == 'high' || getCheckedVal == 'popularity' || getCheckedVal == 'rating'){
            for ( var i = 70 ; i < 775 ; i++){
              
             HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
            }
            }else{
              for ( var k = 775 ; k >= 70  ; k--){
                
                HTML += getProductTemplate(newArrProducts[k].url , newArrProducts[k].image , newArrProducts[k].name, newArrProducts[k].price, newArrProducts[k].product_id, newArrProducts[k].brand.toLowerCase().replace('_','-'),newArrProducts[k].main_cat[0],newArrProducts[k].main_cat[0],newArrProducts[k].stars,newArrProducts[k].rating_count,newArrProducts[k].rating,newArrProducts[i].sold);
              }
            }
            
            $('.product-searchbar .row').append(HTML);
            jQuery('.product_card').each(function(){
              if($(this).css('display') !== 'none'){
                countProductDiv++;
              }
            });   
          },1000)
          setTimeout(function(){
            startCounter(72,countTotalProducts);
          },1200);
      });
    }else if (getCheckedVal == 'sale'){
       $('.product-searchbar .row').html('');
        var HTML = '';
        const newArrProducts = AllProducts.filter((item) => item.main_cat.includes('aquarium-sale'));
        var removeDublicatesFromProducts = [];
        // console.log(newArrProducts);
        var HTML = '';
        for(k in newArrProducts){
          if(jQuery.inArray(newArrProducts[k].name, removeDublicatesFromProducts) == -1){
             removeDublicatesFromProducts.push(newArrProducts[k]);
          }
        }
        for(i in removeDublicatesFromProducts){
         HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],'aquarium-sale',newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
        }

        if($('.all_selections').html() == ''){
          $('.product-searchbar .row').replaceWith(HTML);

        }else{
          $('.product-searchbar .row').append(HTML);
        }

        var countProductDiv = 0;
        jQuery('.product_card ').each(function(){
          if($(this).css('display') !== 'none'){
            if($(this).css('display') !== 'none'){
            countProductDiv++;
            }
          }
        });
        $('.product_count').html('Products Count : <span class="count_num"> </span> ');
        startCounter(0,countProductDiv);
        $('.product_count').show();
    }

  }else if(checkParentCheck == 1 || checkBrandCheck == 1){
    if(getCheckedVal == 'lowest' || getCheckedVal == 'high' || getCheckedVal == 'date' || getCheckedVal == 'popularity' || getCheckedVal == 'rating') {
      var getExistingProductsDiv = [];
      jQuery('.product_card').each(function(){
        var getAllClasses = jQuery(this).attr('class');
        const myArray = getAllClasses.split(" ");
        if(getCheckedVal == 'popularity'){
          var splitPrice = myArray[12].split("item_sold_");
          getExistingProductsDiv.push([splitPrice[1],getAllClasses,jQuery(this).html()]);
        }else if(getCheckedVal == 'rating'){
          var splitPrice = myArray[11].split("average_");
          getExistingProductsDiv.push([splitPrice[1],getAllClasses,jQuery(this).html()]);
        }else{
          var splitPrice = myArray[7].split("proc_price_");
          getExistingProductsDiv.push([splitPrice[1],getAllClasses,jQuery(this).html()]);
        }
        
      })
      if (getCheckedVal == 'lowest'){
        getExistingProductsDiv.sort(function(a, b){return a[0] - b[0]});
      }else if(getCheckedVal == 'high'){
        getExistingProductsDiv.sort(function(a, b){return b[0] - a[0]});
      }else if(getCheckedVal == 'popularity'){
        getExistingProductsDiv.sort(function(a, b){return b[0] - a[0]});
      }else if(getCheckedVal == 'rating'){
        getExistingProductsDiv.sort(function(a, b){return b[0] - a[0]});
      }
      
      


      HTML = '';
      if(getCheckedVal == 'date'){
        for(l in getExistingProductsDiv.reverse()){
        HTML += `<div class="${getExistingProductsDiv[l][1]}">${getExistingProductsDiv[l][2]}</div>`
        }
      }else{
        for(l in getExistingProductsDiv){
        HTML += `<div class="${getExistingProductsDiv[l][1]}">${getExistingProductsDiv[l][2]}</div>`
        }
      }
      
      $('.product-searchbar .row').html(HTML);

       var countProductDiv = 0;
        jQuery('.product_card ').each(function(){
          if($(this).css('display') !== 'none'){
            if($(this).css('display') !== 'none'){
              countProductDiv++;
            }
          }
        });
        $('.product_count').html('Products Count : <span class="count_num"> </span> ');
        startCounter(0,countProductDiv);
    }else if(getCheckedVal == 'sale'){
      $('.product_card').hide();
      $('.product_card.on_sale').show();
         var countProductDiv = 0;
        jQuery('.product_card ').each(function(){
          if($(this).css('display') !== 'none'){
            if($(this).css('display') !== 'none'){
              countProductDiv++;
            }
          }
        });
        $('.product_count').html('Products Count : <span class="count_num"> </span> ');
        startCounter(0,countProductDiv);
    }
  

  }
  }else{
    $('.product-searchbar .row').html('');
    $('.product_card').hide();
      $('.product_card.on_sale').show();
         var countProductDiv = 0;
        jQuery('.product_card ').each(function(){
          if($(this).css('display') !== 'none'){
            if($(this).css('display') !== 'none'){
              countProductDiv++;
            }
          }
        });
        $('.product_count').html('Products Count : <span class="count_num"> </span> ');
        startCounter(0,countProductDiv);
  }


});

$(document).on('click','.price-search-rang h3', function(){
  $('.price-range-slider').toggle();
});
$(document).on('click','.pssorting h3', function(){
  $('form.pssorting-form').toggle();
});
$(document).on('click','.psbrand h3',function(){
  $('form.psbrand-form').toggle();
});
$(document).on('click','.pscat h3',function(){
  $('form.pscat-form').toggle();
});


$(document).on('change','.psbrand-check',function (e) {

e.preventDefault(); // avoid to execute the actual submit of the form. 

var getBrandVal = $(this).val();
var getBrandTag = $(this).attr('data-tag');


jQuery('.product-searchbar .product_card').hide();
$('.psbrand-form input').each(function(){
  var getBrandVal = $(this).val();
  if($(this).prop('checked')){
    var getBrandTag = $(this).attr('data-tag');
    jQuery('.product-searchbar .product_card.'+getBrandVal).show();
  }
})


var checkParentCheck = 0;
$('input.pscat-check').each(function(){
  if($(this).prop('checked')){
    checkParentCheck = 1;
  }
});


if(checkParentCheck  == 0){
  var HTML = '';
    
  for(l in AllBrandArr){
    if( AllBrandArr[l].brand.toLowerCase().replace('_','-') == getBrandVal){
      HTML += getProductTemplate(AllBrandArr[l].url , AllBrandArr[l].image , AllBrandArr[l].name, AllBrandArr[l].price, AllBrandArr[l].product_id, AllBrandArr[l].brand.toLowerCase().replace('_','-'),'',getBrandVal,AllBrandArr[l].stars,AllBrandArr[l].rating_count,AllBrandArr[l].rating,AllBrandArr[l].sold);
    }
  } 
  if($('.all_selections').html() == ''){
    $('.product-searchbar .row').replaceWith(HTML);

  }else{
    $('.product-searchbar .row').append(HTML);
  }
}
 
$(".all_selections").append('<div class="selected-filter brand_tag" data-query="'+getBrandVal+'"><span class="selected-filter-field"><font>Brand:</font></span><font> '+getBrandTag+'</font><span class="search-clear-filter"></span></div>'); 
// console.log(getBrandVal);
$('.for_loading').show();
$('.for_loading').hide();

$('form.psbrand-form').hide();

var countProductDiv = 0;
jQuery('.product_card ').each(function(){
  if($(this).css('display') !== 'none'){
    if($(this).css('display') !== 'none'){
        countProductDiv++;
    }
  }
});
$('.product_count').html('Products Count : <span class="count_num"> </span> ');
startCounter(0,countProductDiv);
$('.product_count').show();

get_html_data();



});



var getAllProductsData = '';
$(document).on('change',".pscat-form .parent.pscat-check",function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.    

    var data = ajax_result_action();
    $('.for_loading').show(); 
    $('form.pscat-form').hide();
    $(this).parents('.parent_li').find('.child').each(function () {
      $(this).prop('checked');
    });

    var getCatVal = $(this).val();
    var getCatNum = $(this).parents('label').children('.count-category-num').html();
    var removeBracket_1 = getCatNum.replace('(','');
    var removeBracket_2 = removeBracket_1.replace(')','');
    if ($(this).prop("checked")){
    // var HTML = '<div class="row '+getCatVal+' ">';
    var HTML = '';
    const newArrProducts = AllProducts.filter((item) => item.main_cat.includes(getCatVal));
    var removeDublicatesFromProducts = [];
    // console.log(newArrProducts);
    var HTML = '';
    for(k in newArrProducts){
      if(jQuery.inArray(newArrProducts[k].name, removeDublicatesFromProducts) == -1){
         removeDublicatesFromProducts.push(newArrProducts[k]);
      }
    }

    for(i in removeDublicatesFromProducts){
     HTML += getProductTemplate(removeDublicatesFromProducts[i].url , removeDublicatesFromProducts[i].image , removeDublicatesFromProducts[i].name, removeDublicatesFromProducts[i].price, removeDublicatesFromProducts[i].product_id, removeDublicatesFromProducts[i].brand.toLowerCase().replace('_','-'),removeDublicatesFromProducts[i].main_cat[0],getCatVal,removeDublicatesFromProducts[i].stars,removeDublicatesFromProducts[i].rating_count,removeDublicatesFromProducts[i].rating,removeDublicatesFromProducts[i].sold);
    }

    if($('.all_selections').html() == ''){
      $('.product-searchbar .row').replaceWith(HTML);

    }else{
      $('.product-searchbar .row').append(HTML);
    }

    var countProductDiv = 0;
      jQuery('.product_card').each(function(){
        if($(this).css('display') !== 'none'){
          if($(this).css('display') !== 'none'){
          countProductDiv++;
          }
        }
      });
      $('.product_count').html('Products Count : <span class="count_num"> </span> ');
      startCounter(0,countProductDiv);
    

    $('.product_count').show();

  }
  $('.for_loading').hide();


    var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!

    $.ajax({
      url: ajaxurl,
      data: data,
      type: "POST",
      success: function(results) {
       var result_data = JSON.parse(results);
         // $('.product-searchbar .row').replaceWith(result_data.post_data);
         $('.sort-topsearch form.psbrand-form').html(result_data.brands);
            // $('.sort-topsearch form.psbrand-form').html(e);
            // re_init_rang_slider();
            get_html_data();

        //console.log(e);
      }
    });
    
  });


$(document).on('change',".pscat-form .child.pscat-check",function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.  

    var getCatVal = $(this).val();
    var getParentCat = $(this).data('parent');

    if($('input[value="'+getParentCat+'"]').is(':checked')){
      if ($(this).prop("checked")){
       $(".all_selections").append('<div class="selected-filter category_tag '+getCatVal+' " data-query="'+getCatVal+'"><span class="selected-filter-field"><font>Category:</font></span><font> '+$(this).data('tag')+'</font><span class="search-clear-filter"></span></div>');
      }else{
       $('.'+getCatVal).remove();
      }
    }else{
      $('form.pscat-form').hide();
        $(this).parents('.parent_li').find('.child').each(function () {
          $(this).prop('checked');
        });

        if ($(this).prop("checked")){
        // var HTML = '<div class="row '+getCatVal+' ">';
        var HTML = '';
        const newArrProducts = AllProducts.filter((item) => item.main_cat.includes(getCatVal));
        var removeDublicatesFromProducts = [];
        // console.log(newArrProducts);
        var HTML = '';
        for(k in newArrProducts){
          if(jQuery.inArray(newArrProducts[k].name, removeDublicatesFromProducts) == -1){
             removeDublicatesFromProducts.push(newArrProducts[k]);
          }
        }

        for(i in removeDublicatesFromProducts){
         HTML += getProductTemplate(removeDublicatesFromProducts[i].url , removeDublicatesFromProducts[i].image , removeDublicatesFromProducts[i].name, removeDublicatesFromProducts[i].price, removeDublicatesFromProducts[i].product_id, removeDublicatesFromProducts[i].brand.toLowerCase().replace('_','-'),removeDublicatesFromProducts[i].main_cat[0],getCatVal,removeDublicatesFromProducts[i].stars,removeDublicatesFromProducts[i].rating_count,removeDublicatesFromProducts[i].rating,removeDublicatesFromProducts[i].sold);
        }

        if($('.all_selections').html() == ''){
          $('.product-searchbar .row').replaceWith(HTML);

        }else{
          $('.product-searchbar .row').append(HTML);
        }

        var countProductDiv = 0;
          jQuery('.product_card').each(function(){
            if($(this).css('display') !== 'none'){
              if($(this).css('display') !== 'none'){
              countProductDiv++;
              }
            }
          });
          $('.product_count').html('Products Count : <span class="count_num"> </span> ');
          startCounter(0,countProductDiv);
        

        $('.product_count').show();
        $(".all_selections").append('<div class="selected-filter category_tag '+getCatVal+' " data-query="'+getCatVal+'"><span class="selected-filter-field"><font>Category:</font></span><font> '+$(this).data('tag')+'</font><span class="search-clear-filter"></span></div>');
      }else{
       $('.'+getCatVal).remove();
      }   
    }

  
    
});


$('#my_popup .topsearchbx button.searchsubmit').attr('type', 'button');

$(document).on('click','.pscat-form li',function (e) {

  if($(this).hasClass('parent_li') && $(this).find('.parent').prop('checked')){

    $(this).find('.child_ul').show();

  }else{

  }


}); 

});

function re_init_rang_slider(){

  var max = $(document).find('.max_p').val();
  var min = $(document).find('.min_p').val();


  $("#slider-range").slider("values", 0, min);  
  $("#slider-range").slider("values", 1, max ); 
  $( "#amount" ).val( "€" + min + " - €" + max );   



}


function ajax_result_action(sorting = '' ){

  var i = 0;
  var catformDataq = '';
  var brandformDataq = '';
  var catformData = '';
  var brandformData = '';

  $(".all_selections .category_tag").remove();

  $(document).find(".pscat-form input[type='checkbox']").each(function() {



   var element = $(this);
   if (!element.prop('checked')) {



   }else{

    catformDataq += "pscate[]="+element.val()+"&"; 
    catformData += element.val()+"|"; 

    $(".all_selections").append('<div class="selected-filter category_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Category:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              


  }


});


  $(".all_selections .brand_tag").remove();
  $(document).find(".psbrand-form input[type='checkbox']").each(function() {
   var element = $(this);

   if (!element.prop('checked')) {



   }else{

    brandformDataq += "brand[]="+element.val()+"&"; 
    brandformData += element.val()+"|"; 

    $(".all_selections").append('<div class="selected-filter brand_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Brand:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              

  }


});
  var min = 5;
  var max = 500;
  var  prices =   'minprice='+min+"&maxprice="+max;

  window.location.hash = "product-search?search="+$(".ps").val()+"&"+brandformDataq+""+catformDataq+""+prices+"&sorting="+sorting+"&popup=on";

  $(".all_selections .sorting_tag").remove();

  jQuery(".pssorting-check").each(function(){
    var element = $(this);
    if (element.prop('checked')) {
      sorting = element.val();
      // $(".all_selections").append('<div class="selected-filter sorting_tag" data-query="'+sorting+'"><span class="selected-filter-field"><font>Sorting:</font></span><font> '+sorting+'</font><span class="search-clear-filter"></span></div>');              

    }
  });





  var data = {
    action: 'folder_contents',
    pscat: catformData,
    psbrand:brandformData,
    ps:$(".ps").val(),
    pssorting:sorting,
    minprice:min,
    maxprice:max,
  };


  var str = data ;


  localStorage.setItem('myhtml', JSON.stringify(str));

  localStorage.setItem('ps', $(".ps").val());

  return data;
}




$(document).ready(function() {

  $('div#my_popup > .wd-popup-inner >.wpb_text_column.wpb_content_element > .wpb_wrapper').html(getUrlVars()['popuphtml']);

  jQuery(document).on('click','.my-close',function(){


    $(".con_tain").html($(".con_tain_empy").html());
    $(".psbrand-form").html($(".psbrand-form_empty").html());
    $(".pssorting-form").html($(".pssorting_empty").html());
    $('.price-range-slider').hide();
    $('.psbrand-form').hide();
    $('.pscat-form').hide();
    $('.pssorting-form').hide();

    $(document).find(".all_selections ").html(' ');
    $('.top_search_new_pop').removeClass('active_pop');
    $("body").removeClass('over_hidden');
    window.location.hash = "#s";
    $(".ps").val('');
    $(".for_loading").hide();
    $('.product-searchbar .row').html('<span> </span>');

    $("#slider-range").slider("values", 0, 5);  
    $("#slider-range").slider("values", 1, 500 ); 
    $( "#amount" ).val( "€" + 5 + " - €" + 500 );  

  });


  $('.top_search_new_pop').click(function(e){   
   var click=$(e.target);
   var outsideDiv=$(".top_search_new_pop");
   if(click.is(outsideDiv)){


    $("button.my-close").trigger('click');

  }}); 



  if(getUrlVars()['popup'] == 'on'){

    $(".ps").val(localStorage.getItem('ps'));

    $('.top_search_new_pop').addClass('active_pop');
    $("body").addClass('over_hidden');

    $(".for_loading").show();
            var ajaxurl = 'https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php';  //WHAT IS THIS?!?!

            $.ajax({
              url: ajaxurl,
              data: JSON.parse(localStorage.getItem('myhtml')),
              type: "POST",
              success: function(results) {


               var result_data = JSON.parse(results);
               $('.product-searchbar .row').replaceWith(result_data.post_data);


               $(document).find(".all_selections .category_tag").remove();
               $(document).find(".pscat-form input[type='checkbox']").each(function() {
                 var element = $(this);
                 if (!element.prop('checked')) {
                 }else{
                  $(document).find(".all_selections").append('<div class="selected-filter category_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Category:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              
                }
              });

               $(document).find(".all_selections .brand_tag").remove();
               $(document).find(".psbrand-form input[type='checkbox']").each(function() {
                 var element = $(this);
                 if (!element.prop('checked')) {
                 }else{

                  $(document).find(".all_selections").append('<div class="selected-filter brand_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Brand:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              
                }
              });

               $('.for_loading').hide();

        //console.log(e);
      }
    });
            
          }

        });

function get_html_data(){



  $(".all_selections .category_tag").remove();
  var brand = 0;
  var cat  = 0;
  $(document).find(".pscat-form input[type='checkbox']").each(function() {



   var element = $(this);
   if (!element.prop('checked')) {



   }else{

     cat +=1;
     $(".all_selections").append('<div class="selected-filter category_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Category:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              


   }


 });


  $(".all_selections .brand_tag").remove();
  $(document).find(".psbrand-form input[type='checkbox']").each(function() {
   var element = $(this);

   if (!element.prop('checked')) {



   }else{
     brand +=1;

     $(".all_selections").append('<div class="selected-filter brand_tag" data-query="'+element.val()+'"><span class="selected-filter-field"><font>Brand:</font></span><font> '+element.data('tag')+'</font><span class="search-clear-filter"></span></div>');              

   }


 });

  if( brand  < 1){
    $(".all_selections .brand_tag").remove();
  }else if(cat  < 1){
    $(".all_selections .category_tag").remove();
  }




}



function getUrlVars()
{
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i < hashes.length; i++)
  {
    hash = hashes[i].split('=');
    vars.push(hash[0]);
    vars[hash[0]] = hash[1];
  }
  return vars;
}



jQuery(document).ready(function($){

    $(document).on('click','.for_product_check',function() {

      var getProductId = $(this).data('pid');

      $(`.post-${getProductId}`).parents('.slide-product').append("<div class='loader_var'><i class='fa fa-spinner fa-spin'></i></div>");

      // console.log(getProductId);

      if ($(this).hasClass('active') && $(this).find(".add_to_cart_button").hasClass('product_type_variable')) {

       var ajaxurl = `https://demo7.1stopwebsitesolution.com/aquarium/wp-admin/admin-ajax.php?action=woodmart_quick_shop&id=${getProductId}`;  
       $.ajax({
        url: ajaxurl,
        type: "POST",
        success: function(res) {
         $(`.post-${getProductId}`).parents('.slide-product').children('.loader_var').remove();

         if(res != ''){

          $(`.post-${getProductId}`).parents('.slide-product').append("<div class='afterajaxdiv'>"+res+"</div>");

          $(`.afterajaxdiv .single_variation_wrap`).hide();
          $(`.post-${getProductId} #pa_grootte`).val($(`.post-${getProductId} #pa_grootte option:first`).val());
          $('select option')
          .filter(function() {
            return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
          })
          .remove();
        }

        // console.log(res);
      },
      error: function(e) {
       console.log('noajax');
     }
   });
     }else{

       $(`.post-${getProductId}`).parents('.slide-product').children('.afterajaxdiv').remove();
       $(`.post-${getProductId}`).parents('.slide-product').children('.loader_var').remove();
     }
   });


  });


if(document.getElementsByClassName("min_error").length > 0){

  document.querySelector('.wc-proceed-to-checkout').classList.add('dis_able');

}



$(document).find("#slider-range" ).slider({

  range: true,
  min: 1,
  max: 650,
  values: [ 0, 100 ],
  slide: function( event, ui ) {
    $( "#amount" ).val( "€" + ui.values[ 0 ] + " - €" + ui.values[ 1 ] );
  },
  stop: function(event, ui) {
   var catformData = '';
   var brandformData = '';
   $(document).find(".pscat-form input[type='checkbox']").each(function() {
     var element = $(this);
     if (!element.prop('checked')) {
     }else{

      catformData += element.val()+"|"; 
    }

  });

   $(document).find(".psbrand-form input[type='checkbox']").each(function() {
     var element = $(this);

     if (!element.prop('checked')) {

     }else{

      brandformData += element.val()+"|"; 

    }

  });


   var minprice = $( "#slider-range" ).slider( "values", 0 );
   var maxprice = $( "#slider-range" ).slider( "values", 1 );

   $("#max_price").val(maxprice);
   $("#min_price").val(minprice);


   var data = {
    action: 'folder_contents',
    pscat: catformData,
    psbrand:brandformData,
    ps:$(".ps").val(),
    pssorting:$(".pssorting-check").val(),
    minprice:minprice,
    maxprice:maxprice,
  };

  // $('.for_loading').show();
  // console.log(maxprice);
  // console.log(minprice);
  renderRangePrice(minprice,maxprice);

  }
});

function renderRangePrice(min,max){
  checkParentCheck = 0;
  checkParentArray = [];
  $('input.pscat-check').each(function(){
    if($(this).prop('checked')){
      checkParentCheck = 1;
      checkParentArray.push($(this).val());
    }
  });
  
  checkBrandCheck = 0
  checkBrandArray = [];
  $('input.psbrand-check').each(function(){
    if($(this).prop('checked')){
      checkBrandCheck = 1;
      checkBrandArray.push($(this).val());
    }
  });
  
  
  if(checkParentCheck == 0 && checkBrandCheck == 0){
    $('.product-searchbar .row').html('');
    AllProductsPrice = [];
    $.getJSON( "https://demo7.1stopwebsitesolution.com/aquarium/products_json/products.json", function( data ) {
        for(i in data){
          AllProductsPrice.push(data[i]);
        }
        const newArrProducts = AllProductsPrice.filter(function(item){ return item.price >= min && item.price <= max});
        var countTotalProducts = newArrProducts.length;
        var HTML = '';
        for ( var i = 0 ; i <= 70 ; i++){
          HTML += getProductTemplate(newArrProducts[i].url , newArrProducts[i].image , newArrProducts[i].name, newArrProducts[i].price, newArrProducts[i].product_id, newArrProducts[i].brand.toLowerCase().replace('_','-'),newArrProducts[i].main_cat[0],newArrProducts[i].stars,newArrProducts[i].rating_count,newArrProducts[i].rating,newArrProducts[i].sold);
        }
        $('.product-searchbar .row').append(HTML);
          var countProductDiv = 0;
            jQuery('.product_card ').each(function(){
              if($(this).css('display') !== 'none'){
              countProductDiv++;
            }
            });
            $('.product_count').html('Products Count : <span class="count_num"> </span> ');
            startCounter(0,countProductDiv);
            $('.product_count').show(); 
        $('.for_loading').hide();
        setTimeout(function(){
          HTML = '';
          for ( var k = 51 ; k < countTotalProducts ; k++){
            HTML += getProductTemplate(newArrProducts[k].url , newArrProducts[k].image , newArrProducts[k].name, newArrProducts[k].price, newArrProducts[k].product_id, newArrProducts[k].brand.toLowerCase().replace('_','-'),newArrProducts[k].main_cat[0],newArrProducts[k].stars,newArrProducts[k].rating_count,newArrProducts[k].rating,newArrProducts[k].sold);
          }
          $('.product-searchbar .row').append(HTML);
          var countProductDiv = 0;
          jQuery('.product_card').each(function(){
            if($(this).css('display') !== 'none'){
              countProductDiv++;
            }
          });   
        },1000)
        setTimeout(function(){
          startCounter(72,countTotalProducts);
        },1200);
    });
  }else if(checkParentCheck == 1 && checkBrandCheck == 0 ){
    $('.product_card').css('display','none');
    for(i = min-1 ; i <= max; i++){
      $('.proc_price_'+i).css('display','block');
    }
    var countProductDiv = 0;
    jQuery('.product_card ').each(function(){
      if($(this).css('display') !== 'none'){
        if($(this).css('display') !== 'none'){
          countProductDiv++;
        }
      }
    });
    $('.product_count').html('Products Count : <span class="count_num"> </span> ');
    startCounter(0,countProductDiv);
  }else if(checkParentCheck == 0 && checkBrandCheck == 1){
    
    $('.product_card').css('display','none');
    for(i = min-1 ; i <= max; i++){
      for(k in checkBrandArray){
        $('.'+checkBrandArray[k]+'.proc_price_'+i).css('display','block');
      }
    }
    var countProductDiv = 0;
    jQuery('.product_card ').each(function(){
      if($(this).css('display') !== 'none'){
        if($(this).css('display') !== 'none'){
          countProductDiv++;
        }
      }
    });
    $('.product_count').html('Products Count : <span class="count_num"> </span> ');
    startCounter(0,countProductDiv);
  }else if(checkParentCheck == 1 && checkBrandCheck == 1){
    $('.product_card').css('display','none');
    for(i = min-1 ; i <= max; i++){
      for(k in checkBrandArray){
        $('.'+checkBrandArray[k]+'.proc_price_'+i).css('display','block');
      }
    }
    var countProductDiv = 0;
    jQuery('.product_card ').each(function(){
      if($(this).css('display') !== 'none'){
        if($(this).css('display') !== 'none'){
          countProductDiv++;
        }
      }
    });
    $('.product_count').html('Products Count : <span class="count_num"> </span> ');
    startCounter(0,countProductDiv);
  }
}

function startCounter(start,count) {
  const maxCounter = count;
  $({
    Counter: start
  }).animate({
    Counter: maxCounter
  }, {
    duration: 1000,
    easing: 'swing',
    step: function() {
      $('.count_num').text(Math.ceil(this.Counter));
    }
  });
}

// function to render products html
function getProductTemplate(url , img , title, price, id ,brand, main_cat,present_cat,star_rating,rating_count,rating,sold){
  
  var getSaleVeriable = '';
  var onSale = 'not_on_sale';
  if(title == 'HS AQUA CLEAR VOOR HELDER WATER'){
    getSaleVeriable = '-13%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA FLORA CARBO PLANTENVOEDING MET CO2 TOEVOEGING'){
    getSaleVeriable = '-12%';
    onSale = 'on_sale';
  }else if(title == 'ANTI ALGEN ALGENBESTRIJDING TETRA ALGUMIN'){
    getSaleVeriable = '-23%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA FLORACELL PLANTENVOEDING 14 DAGEN'){
    getSaleVeriable = '-8%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA CO2 STARTER SET'){
    getSaleVeriable = '-10%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA FISH GUARD VOOR GEZONDE VISSEN'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'HOBBY BRAVO ALGENSPONS'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'Aquarium kwaliteit teststrips 6 waarden'){
    getSaleVeriable = '-15%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM PLANT CARE 24H DAGELIJKSE BEMESTING'){
    getSaleVeriable = '-25%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM BUITENFILTER EXPERIENCE'){
    getSaleVeriable = '-9%';
    onSale = 'on_sale';
  }else if(title == 'HOBBY OXYLETTEN ZUURSTOFTABLET'){
    getSaleVeriable = '-5%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA SPONGE & CARBON VOOR INTERNAL FILTER TICO'){
    getSaleVeriable = '-20%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM WATER CARE HEALTH TONIC TBV VIS / PLANT'){
    getSaleVeriable = '-13%';
    onSale = 'on_sale';
  }else if(title == 'GEBOGEN PINCET AQUASCAPE PRO'){
    getSaleVeriable = '-13%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM BUITEN THERMOFILTER PROF 3'){
    getSaleVeriable = '-2%';
    onSale = 'on_sale';
  }else if(title == 'Helder Water Totaal Pakket'){
    getSaleVeriable = '-15%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA CO2 MAX MIX REACTOR'){
    getSaleVeriable = '-14%';
    onSale = 'on_sale';
  }else if(title == 'Extra batterijen (2 stuks) HS Aqua Battery Cleaner'){
    getSaleVeriable = '-34%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM WATER CARE PH/KH PUFFER ZOETWATER'){
    getSaleVeriable = '-27%';
    onSale = 'on_sale';
  }else if(title == 'PENN PLAX KUNSTOF PLANTEN ZES STUKS'){
    getSaleVeriable = '-40%';
    onSale = 'on_sale';
  }else if(title == 'PENN PLAX PLANT GROEN BLOOMING LUDWIGIA'){
    getSaleVeriable = '-39%';
    onSale = 'on_sale';
  }else if(title == 'DENNERLE ALLES IN 1 CO2 PLANTENBEMESTINGSSET'){
    getSaleVeriable = '-9%';
    onSale = 'on_sale';
  }else if(title == 'TETRA WATERTESTSET (LABORETT)'){
    getSaleVeriable = '-9%';
    onSale = 'on_sale';
  }else if(title == 'HOBBY PLANT HETERANTHERA'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'HS AQUA CARBON ACTIVE (kool)'){
    getSaleVeriable = '-14%';
    onSale = 'on_sale';
  }else if(title == 'AQUAEL FILTERCARTRIDGE TBV ASAP'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM WATER CARE FILTER STARTER ZOETWATER'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'Anti Algen Totaal Pakket'){
    getSaleVeriable = '-16%';
    onSale = 'on_sale';
  }else if(title == 'DENNERLE CO2 WEGWERPFLES'){
    getSaleVeriable = '-14%';
    onSale = 'on_sale';
  }else if(title == 'EHEIM PROFESSIONEL FOOD GREEN TABS 275 ML VOOR BODEMVISSEN'){
    getSaleVeriable = '-20%';
    onSale = 'on_sale';
  }else if(title == 'AQUA PINCET RECHT PRO'){
    getSaleVeriable = '-7%';
    onSale = 'on_sale';
  }else if(title == 'JUWEL VOEDERAUTOMAAT EASYFEED'){
    getSaleVeriable = '-10%';
    onSale = 'on_sale';
  }else if(title == 'ONE BENT PINCET PRO MET LUXE HOES'){
    getSaleVeriable = '-6%';
    onSale = 'on_sale';
  }else if(title == 'Zand afvlakker (Sand flattener) Aquascape Pro'){
    getSaleVeriable = '-6%';
    onSale = 'on_sale';
  }else if(title == 'Aquarium schaar recht Aquascape pro'){
    getSaleVeriable = '-17%';
    onSale = 'on_sale';
  }else if(title == 'Plantenschaar gebogen Aquascape Pro'){
    getSaleVeriable = '-20%';
    onSale = 'on_sale';
  }else if(title == 'Aquascape pro Wave plantenschaar'){
    getSaleVeriable = '-20%';
    onSale = 'on_sale';
  }

  if(rating_count == 0){
    var noShow = 'remove_rating';
  }else{
    var noShow = 'show_rating';
  }

  var saleDiv = '';

  if(getSaleVeriable != 0){
  saleDiv = saleDiv = `<div class="product-labels labels-rounded"><span class="onsale product-label">${getSaleVeriable}</span></div>`;
  }

  if(sold == '' || typeof sold === "undefined"){
    var sold = 0;
  }


  return `<div class='col-12 col-sm-6 col-md-3 col-gl-3 product_card ${brand} ${main_cat} proc_price_${Math.round(price)} ${present_cat} ${onSale} popularity_${rating_count} average_${Math.round(rating)}   item_sold_${sold}'><div class='searchbox_pro'>
  <div class='product-wrapper'>
  <div class='product-element-top'>
  <div class="loader_var_popup product_loader_${id}"><i class="fa fa-spinner fa-spin"></i></div>
  ${saleDiv}
  <a href='${url}' class='product-image-link'>
  <div class='product-labels labels-rounded'></div><img width='300' height='300' src='${img}' class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail' alt='' loading='lazy' srcset='${img} 300w, ${img} 150w, ${img} 600w' sizes='(max-width: 300px) 100vw, 300px'>     </a>
  <div class='hover-img'> 
  <a href='${url}'>
  <img width='300' height='300' src='${img}' class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail' srcset='${img} 300w, ${url} 150w, ${url} 600w' sizes='(max-width: 300px) 100vw, 300px'>        </a>
  </div>
  <div class='wd-buttons wd-pos-r-t woodmart-buttons'>
  <link rel='stylesheet' id='wd-mfp-popup-css' href='https://demo7.1stopwebsitesolution.com/aquarium/wp-content/themes/woodmart/css/parts/lib-magnific-popup.min.css?ver=6.1.4' type='text/css' media='all'>            <div class='quick-view wd-action-btn wd-style-icon wd-quick-view-icon wd-quick-view-btn'>
  <a href='${url}' class='open-quick-view quick-view-button' data-id='${id}'>Quick view</a>
  </div>
  <div class='wd-compare-btn product-compare-button wd-action-btn wd-style-icon wd-compare-icon'>
  <a href='${url}' data-id='${id}' data-added-text='Compare products'>
  Compare       </a>
  </div>
  <div class='wd-wishlist-btn wd-action-btn wd-style-icon wd-wishlist-icon woodmart-wishlist-btn'>
  <a class='' href='https://demo7.1stopwebsitesolution.com/aquarium/wishlist/' data-key='de4c69d88a' data-product-id='${id}' data-added-text='Browse Wishlist'>Add to wishlist</a>
  </div>
  </div> 
  <div class='quick-shop-wrapper wd-fill wd-scroll'>
  <div class='quick-shop-close wd-action-btn wd-style-text wd-cross-icon'><a href='#' rel='nofollow noopener'>Close</a></div>
  <div class='quick-shop-form wd-scroll-content'>
  </div>
  </div>
  </div>

  <div class='product-list-content'>
  <h3 class='wd-entities-title'><a href='${url}'>${title}</a></h3>            
  <div class='woocommerce-product-rating ${noShow}'>
  ${star_rating}    
  </div>
  <a href="https://demo7.1stopwebsitesolution.com/aquarium/shop/hs-aqua-clear-voor-helder-water/#reviews" class="woocommerce-review-link ${noShow}" rel="nofollow noopener"><span class="count">${rating_count}</span> Beoordelingen</a>

  <a rel="nofollow" id="cart_btn_load" href="/?add-to-cart=${id}" data-quantity="1" data-product_id="${id}" data-product_sku="" class="add_to_cart_button  ajax_add_to_cart">Add to cart</a>

  <span class='price'><span class='woocommerce-Price-amount amount'><bdi><span class='woocommerce-Price-currencySymbol'>€</span>${price}</bdi></span> – <span class='woocommerce-Price-amount amount'><bdi><span class='woocommerce-Price-currencySymbol'>€</span>13,95</bdi></span></span>
  <div class='begliumcounter_oncart'><div class='future_date'><i class='fa fa-check-circle check-right our-right'></i>  vandaag besteld, overmorgen in huis.</div></div>      

  <div class='wd-add-btn wd-add-btn-replace woodmart-add-btn'><a href='${url}' data-quantity='1' class='button product_type_variable add_to_cart_button add-to-cart-loop' data-product_id='${id}' data-product_sku='E0000465' aria-label='Select options for “HS AQUA CLEAR VOOR HELDER WATER”' rel='nofollow'><span>Select options</span></a></div>
  </div>
  </div>

  </div>
  </div>`;
}

jQuery(document).scroll(function () {
  var y = jQuery(this).scrollTop();
  if (y > 300) {
    jQuery('.topMenu').fadeIn();
  } else {
    jQuery('.topMenu').fadeOut();
  }

});


jQuery(document).ready(function($){
  $(document).on('click','#cart_btn_load',function(e){
    e.preventDefault();
    var getId = $(this).data('product_id');
    $('.product_loader_'+getId).show();
    setTimeout(function(){
    $('.product_loader_'+getId).hide();
    },5000);
    console.log(getId)
  });
})
