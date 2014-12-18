jQuery(document).ready(function(){
	var datepicker_url = jQuery("#datepicker").val();
		
	jQuery(".bkr_time").each(function(){
		var str = jQuery(this).attr("href");
		var this_href = str.slice(0, str.search(/date=/)+5);
	
		jQuery(this).attr("href", this_href+datepicker_url);
	});

	jQuery("#sort_rooms").click(function(){
		if ( jQuery(this).hasClass("active") ) {
			jQuery(this).removeClass("active");
			jQuery(this).html("&#9660;");
			jQuery("#bkr_td1").after(jQuery("#bkr_td2"));
			jQuery("#bkr_td2").after(jQuery("#bkr_td3"));
		} else {
			jQuery(this).addClass("active");
			jQuery(this).html("&#9650;");
			jQuery("#bkr_td3").after(jQuery("#bkr_td2"));
			jQuery("#bkr_td2").after(jQuery("#bkr_td1"));
		}
		
	});
	
	$(function() {
		jQuery( "#datepicker" ).datepicker();
	});
	
	jQuery("#datepicker").change(function(){
		var datepicker_url = jQuery(this).val();
		
		jQuery(".bkr_time").each(function(){
			var str = jQuery(this).attr("href");
			var this_href = str.slice(0, str.search(/date=/)+5);
		
			jQuery(this).attr("href", this_href+datepicker_url);
		});
		
		window.location.replace("?datepick="+datepicker_url);
		
	});
});