<?php
//start the session
session_start();
if(isset($_SESSION["user_logged"])){
	//page that we want to redirect
	header("Location: home.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Virtual Enterprises</title>
 	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	  <div class="row">
	  	<div class="col-md-8">
			<a href="signin.php">
	  			<img src="img/header.png">
	  		</a>
		</div>
	  </div> 
	  <hr>
	</div>    

    <div class="container"> 
     	<div class="row">
	      <div class="col-md-4 col-md-offset-1">
	     	 <h3>Log into your account</h3>
	     	 <form role="form" method="post" action="signin.php?login=1" name="login">
	     	 	<ul style="width: 360px; list-style-type:none"> 
	     	 	  <li style="width: 340px">
			     	<div class="form-group has-feedback">
			       	  <label>Email:</label>
			          <input class="form-control" type="text" title="User Email" name="userEmail" value="" placeholder="Enter E-mail here"/>
			          <i class="glyphicon glyphicon-user form-control-feedback"></i>
			    	</div>
			      </li>
			      <li style="width: 340px">
			     	<div class="form-group has-feedback"> 
			      	  <label>Password:</label>
			       	  <input class="form-control" type="password" title="Password" name="password" value="" placeholder="Enter Password here"/>
			       	  <i class="glyphicon glyphicon-lock form-control-feedback"></i>
			    	 </div>
			       </li>
			    	 <input type="submit" class="btn btn-primary" value="Submit">  
			    </ul>
	     	 </form>
          </div>	
		  <div class="col-md-4 col-md-offset-1">
	      	<h3>Not registered yet?</h3>
	      	<ul style="width: 360px; list-style-type:none">
	      		<li style="width: 340px; margin-top:10px; margin-bottom:25px">
		      	Whether you are a contractor, a consulting group or an employer, 
		      	join us to find or post a job. You can either manage 
		      	the hiring process on your own or get assistance from our 
		      	Business Managers to help you in the recruiting process.
		      	</li>
		      	<li>
		      		<a class="btn btn-primary" href="register.php">New? Register Here</a>
		      	</li> 
		    </ul>
	      </div> 
     	</div>
    </div>
<?php
	if(isset($_GET["login"])){	
		$login =$_GET["login"];
		if($login == 1){
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == 'POST'){
				$user_email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_STRING); 
				$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
				
				$servername = "localhost";
				$db_username = "root";
				$db_password = "ev2015";
				$db_name = 'mydb';
				
				// Create connection
				$conn = new mysqli($servername, $db_username, $db_password, $db_name);
				
				if($conn->connect_error){
					die("Connection failed: " . $conn->connect_error);
				}
				else{
					//query to execute
					$sql_query = "SELECT id_user,user_role,email FROM users WHERE email='".$user_email."' AND password='".$password."'";
					$result = $conn->query($sql_query);
					
					if($result->num_rows>0){
						//store session variables
						$data = $result->fetch_assoc();
						$_SESSION["user_id"]=$data["id_user"];
						$_SESSION["user_role"]=$data["user_role"];
						$_SESSION["user_mail"]=$data["email"];
						$_SESSION["user_logged"] = true;
						//page that we want to redirect
						//header("Location: home.php");
                        
                            echo("<script>location.href = 'home.php';</script>");
						//die();
					}
					else{
						//wrong email or password
						?>
						<div class="container">
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<div class="alert alert-danger alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>ERROR!</strong> Wrong email or password!
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
			}
		}
	}
?>

<footer class="footer">
	<div class="container">
		<div class="row">
			<div style="text-align: center">
				<p class="text-muted"> Empresas Virtuais - Equipa X @ 2014/2015</p>
			</div>
		</div>
	</div>
</footer>


</body>
</html>