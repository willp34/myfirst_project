var blu = {
	
	onReady : function(){
				$( "#target" ).submit(blu.onSubmit); 
		
	} ,
	onSubmit: function( event ) {
			 data = $(this).serialize();
			
			  $.ajax({
					 type: 'POST',
					 url: 'http://localhost/blubolt_demo/index.php/user/register',
					dataType: "json",
					data: data,
					success: blu.succ,
					error: blu.err,

						});
			
		 //alert( "Handler for .submit() called." );
		  event.preventDefault();
	},
	succ: function(resp) { 
							
							if (resp.error==1){
								
								$("#errors").html(resp.result);
							}
							else{
							
								$("#name").text(resp.result.name);
								$("#email").text(resp.result.email);
								$("#comment").text(resp.result.comment);
								$( "#myModal" ).modal('show');	
							}
							
							
						   //$("#mycart li").show( "slow" );
						   
						   //  $("#To").text(resp);
							//$('select#match_list').attr('disabled',false).html(resp);
							//With the ".html()" method we include the html code returned by AJAX into the matches list
						},
	err :function(jqxHR, except){
						$("#errors").html('<div class="alert alert-danger text-center">error</div>');
					}
};
$(document).ready(blu.onReady);


