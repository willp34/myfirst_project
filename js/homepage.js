var blu = {
	
	onReady : function(){
				$( "#ical_form" ).submit(blu.onSubmit); 
		
	} ,
	onSubmit: function( event ) {
			$form = $(this);
			$action_url = $form.attr("action");
			
			data = $(this).serialize();
			
			  $.ajax({
					 type: 'POST',
					 url: $action_url,
					dataType: "html",
					data: data,
					success: blu.succ,
					error: blu.err,

						});
			
		 //alert( "Handler for .submit() called." );
		  event.preventDefault();
	},
	succ: function(resp) {		
						$("#message").html(resp);
						},
	err :function(jqxHR, except){
						$("#errors").html('<div class="alert alert-danger text-center">error</div>');
					}
};
$(document).ready(blu.onReady);


