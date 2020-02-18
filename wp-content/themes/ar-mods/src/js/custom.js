jQuery(function($){
	$(document).ready(function(){
		
		// superFish
		$("ul.sf-menu").superfish({ 
			autoArrows: true,
			animation:  {opacity:'show',height:'show'}
		});
		
		// back to top
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 'slow');
			return false;
		});
		
		
		// portfolio
		$('.portfolio-item').hover(function(){
			$(this).find("img").stop().animate({opacity:'0.8'}, 100);
			$(this).find("h2").stop(true, true).slideDown("normal"); }
			,function(){
			$(this).find("img").stop().animate({opacity:'1'}, 100);
			$(this).find("h2").stop(true, true).slideUp("fast");
		});
		
		//equal heights
		function equalHeight(group) {
		var tallest = 0;
		group.each(function() {
			var thisHeight = $(this).height();
			if(thisHeight > tallest) {
				tallest = thisHeight;
			}
		});
		group.height(tallest);
	}
	equalHeight($(".portfolio-item-details"))
	
	}); // END doc ready
}); // END function