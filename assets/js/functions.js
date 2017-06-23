$(document).ready(function(){

	$('.button-collapse').sideNav({
	      menuWidth: 200
	    }
	);

	$('.collapsible').collapsible();


	//REMOVE SET TIME OUT
	//setTimeout(function(){
		$(window).ready(function(){
			$('#main-loader').hide();
			$('body').removeClass('not-scroll');
		});
	//}, 3000);


	$('.modal').modal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		inDuration: 300, // Transition in duration
		outDuration: 200, // Transition out duration
		startingTop: '4%', // Starting top style attribute
		endingTop: '10%', // Ending top style attribute
		ready: function(modal, trigger){
		// Callback for Modal open. Modal and trigger parameters available.
		},
		complete: function(){
			//callback for modal close
		}
	});


	//$('select').material_select();



});