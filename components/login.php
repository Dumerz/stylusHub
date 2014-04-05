	<?php
		$echo1 = "Username";
		$echo2 = "Password";
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
				$username = addslashes($username);
				$password = addslashes($password);
				$username = strip_tags($username);
				$password = strip_tags($password);
			
			$sql = "SELECT * FROM `users` WHERE `user_name`='$username'";
			$query = mysql_query($sql)or die(header("location:error_occur.php"));
			$check = mysql_num_rows($query);
   			$attrib = mysql_fetch_array($query);
		   if($check >= 1)
		   		{		    
		         $echo1 = "Accepted Username"; 
			     $sql_p = "SELECT * FROM `users` WHERE `password`='$password'";
			     $q_p = mysql_query($sql_p)or die(header("location:error_occur.php"));
			     $checker = mysql_num_rows($q_p);
			     
			     echo $checker;
		         
		         if($checker >= 1)
		         	{
		            	$_SESSION['user'] = $username;
		            	$_SESSION['field_id'] = $attrib['field_id'];
		            	header("Location:index.php?home");
		         	}
		         else
		         	{
		            $echo2 = "Incorrect Password";
		         	}    
   				}
		   else
		   		{
		    	 $echo1 = "Incorrect Username!";
		   		}
		}
	?>
		<div class="container" id="contact" name="contact">
			<div class="row">
			<br>
				<h1 class="centered"><span class="icon icon-quill" style="color:#3498db"></span>STYLUS HUB</h1>
				<hr>
				<br>
				<br>
				<div class="col-lg-4">
					<h3>Contact Information</h3>
					<p><span class="icon icon-home"></span> 987 San Pablo City, Laguna<br/>
						<span class="icon icon-phone"></span> +34 9884 4893 <br/>
						<span class="icon icon-mobile"></span> +34 59855 9853 <br/>
						<span class="icon icon-envelop"></span> <a href="mailto:admin@sterlingbook.co"> admin@sterlingbook.co</a> <br/>
						<span class="icon icon-twitter"></span> <a href="#"> @Sterling </a> <br/>
						<span class="icon icon-facebook"></span> <a href="#"> Sterling Book </a> <br/>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>Employee Login</h3>
					<p><p>
						<form action="index.php" class="form-horizontal" role="form" method="POST">
						  <div class="form-group">
						    <label for="username" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="username" <?php echo 'placeholder="'.$echo1.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="password" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="password" class="form-control" name="password" <?php echo 'placeholder="'.$echo2.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-lg-10">
						      <button type="submit" name="submit" class="btn btn-success">Log In</button>
						    </div>
						  </div>
					   </form>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>About Us</h3>
					<p>Sterling Publishing is a publishing company that produces scientific books on various subjects. These books are written by our authors who specialize in one particular subject in Science.<br/>Get your own account today
					<a href="index.php?sign_up" class="btn" role="button">Sign Up »</a> 
				</div><!-- col -->
			</div>
		
		</div>