
var menuOpen = false;
function sideMenuOpen(){
	$('.side-menu').width(225);
	$('#wrapper').css({'padding-left':'225px'});
	$('.side-menu li a span').show();
	$('body').css('overflow-x','hidden');
	menuOpen = true;
}
function sideMenuClose(){
	$('.side-menu').width(0);
	$('#wrapper').css({'padding-left':0});
	$('.side-menu li a span').hide();
	$('body').css('overflow-x','auto');
	menuOpen = false;
}
function sideMenu(){
	if(menuOpen){
		sideMenuClose();
	}else{
		sideMenuOpen();
	}
}
jQuery.fn.extend({
	sb_alert: function(classname, msg) {
		this.html('<div class="alert alert-'+classname+' alert-dismissible fade in" role="alert"><button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>'+msg+'</div>');
	},
	sb_alert_clear: function() {
		this.html('');
	}
});
$(document).ready(function(){
	$('.table-responsive').css('overflow','hidden');
	$('.table-responsive').hover(function(){
		$(this).css('overflow','auto');
	}, function() {
		$(this).css('overflow','hidden');
	});
	// $('.alert').delay(3000).fadeOut();
	$('#toggle-menu').click(function(){
		sideMenu();
		return false;
	});
	$( window ).resize(function() {
		if(!$('#toggle-menu').is(":visible")){
			sideMenuOpen();
		}else{
			sideMenuClose();
		}
	});
});