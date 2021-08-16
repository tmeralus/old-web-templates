/*breadcrumbs*/
breadCrumbs = function() {
  
       jQuery("div.breadcrumbs").show();
        jQuery("li.directory").bind("mouseenter mouseleave", function(){
             jQuery("div.breadcrumbs").hide();
        })
        
}

/*site actions*/
siteActions = function() {

       jQuery("div.site-actions").show();
        jQuery("li.site-actions").bind("mouseenter mouseleave", function(){
             jQuery("div.site-actions").hide();
        })

}

/*ribbon navigation*/
jQuery(function(){
    jQuery("div.header ul li.tab a").bind("click", function(){

       var id =  jQuery("div.header ul li").find("a.active").attr("id");
        jQuery("#"+id).removeClass("active");
        if (id!='default') {
        jQuery("."+id).hide();
        }
        jQuery(this).addClass('active');
        var ribbon = jQuery(this).attr("id");
        jQuery("."+ribbon).show();
        return false;
    })

})
