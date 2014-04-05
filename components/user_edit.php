	<?php
		$user = $_SESSION['user'];
		$sql = "SELECT * FROM `users` WHERE `user_name`='$user'";
		$query = mysql_query($sql)or die(header("location:error_occur.php"));
		$current = mysql_fetch_assoc($query);

		$echo1 = $current['user_name'];
		$echo2 = $current['password'];
		$echo3 = $current['sur_name'];
		$echo4 = $current['given_name'];		
		if(isset($_POST['submit']))
		{
			$given_name = $_POST['given_name'];
			$sur_name = $_POST['sur_name'];
			$username = $_POST['username'];
			$password = $_POST['password'];
				$username = addslashes($username);
				$password = addslashes($password);
				$given_name = addslashes($given_name);
				$sur_name = addslashes($sur_name);
				$username = strip_tags($username);
				$password = strip_tags($password);
				$given_name = strip_tags($given_name);
				$sur_name = strip_tags($sur_name);
			
			$sql = "SELECT * FROM `users` WHERE `user_name`='$username'";
			$query = mysql_query($sql)or die(header("location:error_occur.php"));
			$check = mysql_num_rows($query);
   
		   if($check >= 1)
		   		{		     
		         $sql = "SELECT * FROM `users` WHERE `password`='$password'";
		         $query = mysql_query($sql)or die(header("location:error_occur.php"));
		         $check = mysql_num_rows($query);    
   				}
		   else
		   		{                 	
		    	mysql_query("UPDATE users SET user_name = '$username', password = '$password', given_name = '$given_name', sur_name = '$sur_name' WHERE user_name = '$user'")or die(header("location:error_occur.php"));
            	$_SESSION['user'] = $username;
            	header("Location:index.php?home");		    	 
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
				<form action="index.php?user_edit" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
				<div class="col-lg-4">
					<h3>Personal Information</h3>
					<p>
						  <div class="form-group">
						    <label for="given_name" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="given_name" <?php echo 'value="'.$echo4.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="sur_name" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="sur_name" <?php echo 'value="'.$echo3.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-lg-10">
						    </div>
						  </div>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>Employee Account</h3>
					<p>
						  <div class="form-group">
						    <label for="username" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="username" <?php echo 'value="'.$echo1.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="password" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="password" class="form-control" name="password" <?php echo 'value="'.$echo2.'"';?> required>
						    </div>
						  </div>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>Reminder</h3>
					<p>By changing the value of the text field, you are updating the information about your current account. Always remember your username and password<br/>Dont want to update?<a href="index.php?home" class="btn" role="button">Go back to Home »</a></p>
					<button type="submit" name="submit" class="btn btn-success">Update</button>
				</div><!-- col -->
			</div>
		
		</div>
	</form>