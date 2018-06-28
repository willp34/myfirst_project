

var blu = {
	
	onReady : function(){
				$( "#ical_form" ).submit(blu.onSubmit); 
				$('#products_edit').SetEditable({
					   
					  onEdit: blu.onEdit_method,
					  onDelete: blu.onDelete_method,
					  onBeforeDelete: function() {},
					  onAdd: function() {} ,
					  
				});
		
	} ,
	
	onEdit_method: function(e) { 
	          
				alert(e.find('td:eq(2)').html());
	},
	
	onDelete_method:function() { 
					alert("delte www   "+ $(this).parent().parent());
	},
	onSubmit: function( event ) {
			$form = $(this);
			$action_url = $form.attr("action");
			
			data = $(this).serialize();
			
			  $.ajax({
					 type: 'POST',
					 url: $action_url,
					dataType: "json",
					data: data,
					success: blu.succ,
					error: blu.err,

						});
			
		 //alert( "Handler for .submit() called." );
		  event.preventDefault();
	},
	succ: function(resp) {		
	                    
						$("#message").html(resp.result);
						},
	err :function(jqxHR, except){
						$("#message").html('<div class="alert alert-danger text-center">error</div>');
					}
};
$(document).ready(blu.onReady);


