	<?php
		$echo1 = "Book Title";
		$user = $_SESSION['user'];
		$sql = "SELECT * FROM `users` WHERE `user_name`='$user'";
		$query = mysql_query($sql)or die(header("location:error_occur.php"));
		$current = mysql_fetch_assoc($query);
		$field_id = $current['field_id'];
		$sql2 = "SELECT * FROM `field` WHERE `field_id`='$field_id'";
		$query2 = mysql_query($sql2)or die(header("location:error_occur.php"));
		$current2 = mysql_fetch_assoc($query2);		
		if(isset($_GET['delete'])){
							$abort = $_GET['delete'];
							$sql1 = "DELETE FROM `stylushub`.`books` WHERE `books`.`book_id` = $abort";
							$query1 = mysql_query($sql1)or die(header("location:error_occur.php"));
							header("location:index.php?home");
						}

		if(isset($_POST['submit']))
		{
			$book_title = $_POST['book_title'];
			$book_content = $_POST['book_content'];
			$subject_id = $current['field_id'];
				$book_title = addslashes($book_title);
				$book_content = addslashes($book_content);
				$book_title = strip_tags($book_title);
				$book_content = strip_tags($book_content);
				$author_id = $current['user_id'];
				$date = date("Y/m/d");
			
				$sql = "SELECT * FROM `books` WHERE `book_title`='$book_title'";
				$query = mysql_query($sql)or die(header("location:error_occur.php"));
				$check = mysql_num_rows($query);
   
		   if($check >= 1)
		   		{		    
			         $echo1 = "Sorry Book entry already exist!";  
   				}
		   else
		   		{                 	
	     			$tempFile = $_FILES['book_cover']['tmp_name'];
	     			$targetFile =  $_FILES['book_cover']['name'];  
	        		move_uploaded_file($tempFile,"book_cover/".$targetFile);
					mysql_query("INSERT INTO `books`(`book_title`,`book_content`,`book_cover`,`subject_id`,`author_id`,`date`) VALUES('$book_title','$book_content','$targetFile','$subject_id','$author_id','$date') ")or die(header("location:error_occur.php"));
				}
		}		
	?>

		<div class="container" id="contact" name="contact">
			<div class="row">
			<br>
				<h1 class="centered"><span class="icon icon-quill" style="color:#3498db"></span>STYLUS HUB</h1>
				<hr>
				<br>
				<div class="col-lg-4">
					<h3>My Information</h3>
					<p><br/>
						<img src="<?php echo 'user_image/'.$current['user_image']; ?>" style="width:140px; height:140px; margin-bottom:5px"/><br/>
						Given name : <b><?php echo $current['given_name']; ?></b> <br/>
						Sur name : <b><?php echo $current['sur_name']; ?></b> <br/>
						Username : <b><?php echo $current['user_name']; ?></b> <br/>
						Employee  no : <b><?php echo $current['user_id']; ?></b> <br/>
						Position/ Field : <b><?php echo $current2['field']; ?></b> <br/>						
						<a href="index.php?user_edit"><span class="icon icon-user-plus"></span> Edit My Information </a> <br/>
					</p>
				</div>	
				<div class="col-lg-4">
					<h3>Create New Project</h3>
					<p><p>
						<form action="index.php?home" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="book_title" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="book_title" <?php echo 'placeholder="' .$echo1.'"'; ?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="book_content" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="book_content" placeholder="Book Description" required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="book_content" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="file" class="form-control" name="book_cover" required>
						    </div>
						  </div>						  
						  <div class="form-group">
						    <div class="col-lg-10">
						      <button type="submit" name="submit" class="btn btn-success">Create</button>
						    </div>
						  </div>
					   </form>
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>Existing Projects</h3>
					<p>
					<?php
						$user_id = $current['user_id'];
						$sql = "SELECT * FROM `books` WHERE `author_id`='$user_id' ORDER BY `book_id` DESC";
						$query = mysql_query($sql)or die(header("location:error_occur.php"));
						while($proj = mysql_fetch_array($query))
					{
					?>
						<h5 class="proj"><a href="index.php?book_id=<?php echo $proj['book_id'];?>"><span class="icon icon-pushpin"></span><?php echo ' ' . $proj['book_title'];?></a><a href="index.php?delete=<?php echo $proj['book_id'];?>"><span class="icon icon-cancel-circle" style="float:right;padding-left:10px"> Delete</span></a><a href="index.php?edit=<?php echo $proj['book_id'];?>"><span class="icon icon-pencil" style="float:right;padding-left:10px"> Edit</span></a></h5>
						<span class="icon-small icon-calendar"><?php echo ' ' . $proj['date'];?></span><br/>
					<?php
					}						
					?>
					</p>					
				</div><!-- col -->
			</div>
		
		</div>