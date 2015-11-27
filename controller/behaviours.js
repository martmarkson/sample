function DeleteEntry(action, id){
		
	if(window.confirm('Are you sure you want to delete current entry?')){
	
		$(document).ready(function(){
			
				$.ajax({
					
						type: "POST",
						url: 'requests/silent_mode_requests_min.php',
						data: '&action=' + action + '&rowid=' + id,
						cache: false,
						async: false,
						error: function (XMLHttpRequest, textStatus, errorThrown) {
							alert("An error occured while trying to delete blog event");
							this; // the options for this ajax request
						},
						success: function(data) { 
							// location.reload();
							// manipulate DOM
							$("#results").html(data);
						}
				});
				
		});
	
	}
	

}


function GetHTMLContent(action, id){
	
	$(document).ready(function(){
		
			$.ajax({
				
					type: "POST",
					url: 'requests/silent_mode_requests_min.php',
					data: '&action=' + action + '&id=' + id,
					cache: false,
					async: false,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						//alert("<?=addslashes($_SESSION["language"]["error"])?>");
						alert("An error occured while trying to get contents");
						this; // the options for this ajax request
					},
					success: function(data) { 
					
						if(document.getElementById('htmlcontainer')){
							$("#htmlcontainer").html(data);
							$("#htmlcontainer").fadeIn(1000);
						}
						
					}
			});
			
	});

}


function GetJSONContent(action, id){
	
	$(document).ready(function(){
		
			$.getJSON('requests/silent_mode_requests_min.php', function(data) {
                  $('#stage').html('<p> Product ID: ' + data.productid + '</p>');
                  $('#stage').append('<p>Product name: ' + data.productname+ '</p>');
                  $('#stage').append('<p> Description: ' + data.description+ '</p>');
              });
			
	});

}








