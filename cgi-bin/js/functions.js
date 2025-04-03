$(document).ready(function(){
	$('.m_btn').click(function(){
		$('#user_menu').slideToggle();
	});
	$('#profile').click(function(){
		$('#user_menu').slideUp();
	});
	$('#content').click(function(){
		$('#user_menu').slideUp();
	});
	
	$('.top').click(function(){
		$('html, body').animate({scrollTop: 0}, 'slow');
	});
});