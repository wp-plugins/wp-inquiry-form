
jQuery(function(){
   jQuery('#pop').click(function(){
        jQuery('#main_form').bPopup();
    });
});
jQuery( "#popup-close" ).click(function() {
jQuery(this).closest('.et_pt_item_image').find('.hidden').delay( 800 ).hide(1000); 
});
 