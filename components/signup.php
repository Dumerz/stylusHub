	<?php
		$echo1 = "Username";
		$echo2 = "Password";
		$echo3 = "Surname";
		$echo4 = "Firstname";		
		if(isset($_POST['submit']))
		{
			$given_name = $_POST['given_name'];
			$sur_name = $_POST['sur_name'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$field_id = $_POST['field_id'];		
				$username = addslashes($username);
				$password = addslashes($password);
				$given_name = addslashes($given_name);
				$sur_name = addslashes($sur_name);
				$field_id = addslashes($field_id);				
				$username = strip_tags($username);
				$password = strip_tags($password);
				$given_name = strip_tags($given_name);
				$sur_name = strip_tags($sur_name);
				$field_id = strip_tags($field_id);				
			
			$sql = "SELECT * FROM `users` WHERE `user_name`='$username'";
			$query = mysql_query($sql)or die(header("location:error_occur.php"));
			$check = mysql_num_rows($query);
   			$attrib = mysql_fetch_array($query);
		   if($check >= 1)
		   		{		    
		         $echo1 = "Sorry username already exist!"; 
		         $sql = "SELECT * FROM `users` WHERE `password`='$password'";
		         $query = mysql_query($sql)or die(header("location:error_occur.php"));
		         $check = mysql_num_rows($query);    
   				}
		   else
		   		{
     			$tempFile = $_FILES['user_image']['tmp_name'];
     			$targetFile =  $_FILES['user_image']['name'];  
        		move_uploaded_file($tempFile,"user_image/".$targetFile);
		    	mysql_query(" INSERT INTO `users`(`field_id`,`user_name`,`password`,`user_image`,`sur_name`,`given_name`) VALUES('$field_id','$username','$password','$targetFile','$sur_name','$given_name') ")or die(header("location:error_occur.php"));
            	$_SESSION['user'] = $username;
		        $_SESSION['field_id'] = $field_id;            	
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
				<form action="index.php?sign_up" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
				<div class="col-lg-4">
					<h3>Personal Information</h3>
					<p>
						  <div class="form-group">
						    <label for="given_name" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="given_name" <?php echo 'placeholder="'.$echo4.'"';?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="sur_name" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="sur_name" <?php echo 'placeholder="'.$echo3.'"';?> required>
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
						    	<select class="form-control" name="field_id">
				<?php
					$sql = "SELECT * FROM `field` ";
					$query = mysql_query($sql)or die(header("location:error_occur.php"));
					while($field = mysql_fetch_array($query))
						{
							echo '<option value="'.$field['field_id'].'">'.$field['field'].'</option>';
						}						
				?>
						   		</select>
						    </div>
						  </div>						  
						  <div class="form-group">
						    <div class="col-lg-10">
						      <input type="file" class="form-control" name="user_image" <?php echo 'placeholder="'.$echo2.'"';?> required>
						    </div>
						  </div>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>About Us</h3>
					<p>Sterling Publishing is a publishing company that produces scientific books on various subjects. These books are written by our authors who specialize in one particular subject in Science.<br/>Already have an account?<a href="index.php" class="btn" role="button">Log In »</a></p>
					<button type="submit" name="submit" class="btn btn-success">Sign Up</button>
				</div><!-- col -->
			</div>
		
		</div>
	</form>