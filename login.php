<!DOCTYPE html>
<html lang="en">
<head>
	<!-- K.G.D.R Perera IT15112538 -->
	<title>User Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php	
	
	//Create session in  browser
	session_start();

	//Setting and storing session ID
	$sessionID = session_id(); 

	//Terminate cookie after 1 hour 
	setcookie("session_id",$sessionID,time()+3600,"/","localhost",false,true);

	echo'<script> 
		var csrf_token;

			function loadDOC(method,url,htmlTag)
			{
				var xhttp = new XMLHttpRequest(); 
				xhttp.onreadystatechange = function() 
			{
				if(this.readyState==4 && this.status==200)
			{
				console.log("CSRF token scuessfully fetched : "+this.responseText);
				document.getElementById(htmlTag).value = this.responseText;		   
			}
			};
				xhttp.open(method,url,true);
				xhttp.send();
			}
		</script>';
		
	echo '<div class="container">
			  <h2>Add Comment</h2>
			  <div class="panel panel-default">
				<div class="panel-body">
				<form  method="POST" action="server.php">
				<div class="form-group col-md-6">
					<label for="exampleInput">Comment</label>
					<input type="text" class="form-control" name="user_name"  id="exampleInput" placeholder=""> <br>
					<button class="form-control btn btn-primary" name="submit">Submit</button>
				</div>  			 
				<div class="spacing"><input type="hidden" id="csToken" name="CSR"/></div>
				</form>
				</div>
			  </div>
		  </div>';
	
	 echo '<script> var token = loadDOC("POST","server.php","csToken");  </script>'; 
		
?>

</body>
</html>
