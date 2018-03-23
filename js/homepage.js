
$(document).ready(function () {
 $( "#target" ).submit(function( event ) {
	 data = $(this).serialize();
	
	  $.ajax({
			 type: 'POST',
			 url: 'http://localhost/cable/index.php/user/register',
			dataType: "json",
			data: data,
			success: function(resp) { 
					
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
			error: function(jqxHR, except){
				$("#errors").html('<div class="alert alert-danger text-center">eror</div>');
			}

				});
	
 //alert( "Handler for .submit() called." );
  event.preventDefault();
	}); 
});
