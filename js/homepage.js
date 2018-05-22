var blu = {
	onReady : function(){
				 // array to add correct values
				var dataparse = [];
				
				
				function myjsondata(obj){
					for(var key in obj){
						process(obj[key]);
					}
					return dataparse;
					
				}
				function process(value){
					
					//console.log(value);
							  if(!$.isArray(value)){
									if($.isNumeric(value)){
										dataparse.push(parseFloat(value));
									
								}  
							  }
				}
				
		data ={ "a": "text", "b": "1.00", "c": 1, "d": "2", "e": 5.1, "f": [1], "g": { "v": 1.5 } },
		console.log(myjsondata(data));
		
		$.fn.fun = function(){
			alert("hi");
		};
//		console.log(data.fun());
		
	}
};
$(document).ready(blu.onReady);


