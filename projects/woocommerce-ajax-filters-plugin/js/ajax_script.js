
jQuery(document).ready(function(){
    
// checkboxes function
jQuery(".panel_body input[type='checkbox']").on("change",function(){
    hitAjax();
});

});


function hitAjax(){
     jQuery(".show_results").html('<div class="loader"></div>');
     
                var category_id = [];
                var make = [];
                var power= [];
                
                // preparing the year value
                
                let minYear = parseInt($( "#year-min" ).val());
                let maxYear = parseInt($( "#year-max" ).val());
                let last = minYear;
                let yearArray = [];
                    yearArray.push(minYear);
                    
                while(last != maxYear){
                    yearArray.push((last+1));
                    last = last+1;
                }
// height metrers
                var heightmax_m = $( "#height-max" ).val();
                var heightmin_m = $( "#height-min" ).val();
                
                var heightmax_ft = $( "#ft-max" ).val();
                var heightmin_ft = $( "#ft-min" ).val();
                
                
                                    
                
                
                jQuery(".filter_li_checkbox").each(function(){
                    var type= jQuery(this).attr("data-type");
                    var id = jQuery(this).attr("data-id");
                    if(jQuery(this).is(":checked")){                            
                        switch(type){
                            case "product_cat":
                                category_id.push(id);
                            break;
                            case "pa_power":
                                 power.push(id); 
                            break;
                            case "pa_manufacturer":                    
                                make.push(id);
                            break;
                        }
                    }
                });
                
                var category_ids ='';
                if(category_id !=''){
                    category_ids = category_id.join(",");
                }
                var make_ids ='';
                if(make !=''){
                    make_ids = make.join(",");
                }
                var power_ids ='';
                if(power !=''){
                    power_ids = power.join(",");
                }
                var yearname = '';
                if(yearArray != ''){
                    yearname = yearArray.join(",");
                }
            
            var data = {
        		'action': 'featchResults',
           	 	'product_cat':category_ids,
           	 	'pa_power':power_ids,
           	 	'pa_manufacturer':make_ids,
           	 	'pa_year-modal':yearname,
           	 	"heightmax_m":heightmax_m,
           	 	"heightmin_m":heightmin_m,
           	 	"heightmax_ft":heightmax_ft,
           	 	"heightmin_ft":heightmin_ft,
        	};
                jQuery.ajax({
        		type : "post",
        		url : OBJ.ajaxurl,
        		data : data,
        		beforeSend:function(xhr){
				    // filter.find('button').text('Processing...'); // changing the button label
			    },
    			success: function(response) {
    			    
    			    jQuery(".ajax_result").show();
    			    
    			    jQuery(".on_ajax").hide();
    			    
    			    jQuery(".show_results").html(response);
                        // console.log(response);
                    
        		
        		}
        	 }); 
}