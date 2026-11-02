jQuery(document).ready(function($){
  
    
        
      $('#header_c').owlCarousel({
                loop:false,
                margin:10,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            });
        // venue detail page vendor carousel
        
              $('#venu_local_Vendors').owlCarousel({
                loop:false,
                margin:10,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            });
            
            
            
            
            
            
            jQuery(".vendor_search_filter button").on('click',function(e){

               e.preventDefault();
                $(".loader_container").show();

     var data = {
        		'action': 'loading_vendors_ajax',
           	 	's': jQuery(this).parents('form').find('input[name="search"]').val(),
           	 	'locations':jQuery(this).parents('form').find('select[name="locations"]').val(),
           	 	'vendortype':jQuery(this).parents('form').find('select[name="vendor_type"]').val() ,
           	 	'venu_post':jQuery(this).parents('form').find('select[name="venue_match"]').val()  ,
           
        	};
        	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
        
        
        
        	jQuery.ajax({
        		type : "post",
        		url : OBJ.ajaxurl,
        		data : data,
        		beforeSend:function(xhr){
				    // filter.find('button').text('Processing...'); // changing the button label
			    },
    			success: function(response) {
                         $(".loader_container").hide();
                    $('.vendors_Cards').html();
                    $('.vendors_Cards').html(response);
                    
        		
        		}
        	 })  
                

        });


          // venue

        $('.venu_miltiselect').select2({
          placeholder: 'Please Select ',
          allowClear: true
        });
        $(".venu_select_accommodations").select2({
          placeholder: 'Please Select ',
          allowClear: true,
           maximumSelectionLength: 1
        });
         
        
        
        jQuery(".cf_element_container label").click(function(e){
        e.preventDefault();
        jQuery(this).parents('.cf_element_container').find('.hideable').toggle('slow');
        
        });
        
        // fillters
        
            
              jQuery(".venue_search_filter button").on('click',function(e){
                    e.preventDefault();
                    
                    $(".loader_container").show();
                    
                    
                var form_search = jQuery(this).parents('form').find('input[name="search"]').val();
                var form_guest =  jQuery(this).parents('form').find('input[name="guest"]').val();
                var form_locations =  jQuery(this).parents('form').find('select[name="locations"]').val();
                var form_venuepropertytype = jQuery(this).parents('form').find('select[name="venuepropertytype"]').val();
                var form_facilities = jQuery(this).parents('form').find('select[name="facilities"]').val();
                var form_accommodations = jQuery(this).parents('form').find('select[name="accommodations"]').val();
                var form_accommodationamenities = jQuery(this).parents('form').find('select[name="accommodationamenities"]').val();
                var form_styles = jQuery(this).parents('form').find('select[name="styles"]').val();
              
                
                
                
             
                  var data = {
        		'action': 'loading_venue_ajax',
           	 	's':form_search ,
           	 	'guest':form_guest ,
           	 	'locations':form_locations ,
           	 	'venuepropertytype':form_venuepropertytype ,
           	 	'facilities':form_facilities ,
           	 	'accommodations':form_accommodations ,
           	 	'accommodationamenities':form_accommodationamenities ,
           	 	'styles':form_styles ,
           
        	};
        	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
        
        
        
        	jQuery.ajax({
        		type : "post",
        		url : OBJ.ajaxurl,
        		data : data,
        		beforeSend:function(xhr){
				    // filter.find('button').text('Processing...'); // changing the button label
			    },
    			success: function(response) {
                         $(".loader_container").hide();
                    $('.venu_Cards').html();
                    $('.venu_Cards').html(response);
                    
        		
        		}
        	 })  
                
                
    
        });
       
        

      
  });
  
  