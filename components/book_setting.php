	<?php
		$echo1 = "Wite your Commit in the Book";
		$user = $_SESSION['user'];
		$book_id = $_GET['edit'];
		$_SESSION['book_id'] = $book_id;
		
		$sql = "SELECT * FROM `books` WHERE `book_id`='$book_id'";
		$query = mysql_query($sql)or die(header("location:error_occur.php"));
		$current = mysql_fetch_array($query);
		$subject_id = $current['subject_id'];

		$sql2 = "SELECT * FROM `field` WHERE `field_id`='$subject_id'";
		$query2 = mysql_query($sql2)or die(header("location:error_occur.php"));
		$current2 = mysql_fetch_assoc($query2);		

		$author_id = $current['author_id'];
		$sql = "SELECT * FROM `users` WHERE `user_id`='$author_id'";
		$query = mysql_query($sql)or die(header("location:error_occur.php"));
		$auth = mysql_fetch_array($query);		

		$user = $_SESSION['user'];
		$sql1 = "SELECT * FROM `users` WHERE `user_name`='$user'";
		$query1 = mysql_query($sql1)or die(header("location:error_occur.php"));
		$current1 = mysql_fetch_assoc($query1);
		$user_id = $current1['user_id'];

				$sql = "SELECT * FROM `books` WHERE `author_id`='$user_id' ORDER BY `date` DESC";
				$query = mysql_query($sql)or die(header("location:error_occur.php"));
				while($proj = mysql_fetch_array($query))
				$book_id = $_SESSION['book_id'];

		if(isset($_POST['update']))
		{
			$book_title = $_POST['book_title'];
			$book_content = $_POST['book_content'];
				$book_title = addslashes($book_title);
				$book_content = addslashes($book_content);
				$book_title = strip_tags($book_title);
				$book_content = strip_tags($book_content);
			
				$sql = "UPDATE books SET `book_title` = '$book_title', `book_content` = '$book_content' WHERE `book_id` = '$book_id'";
				$query = mysql_query($sql)or die(header("location:error_occur.php"));
		}		

	?>

		<div class="container" id="contact" name="contact">
			<div class="row">
			<br>
				<h1 class="centered"><span class="icon icon-quill" style="color:#3498db"></span>STYLUS HUB</h1>
				<hr>
				<br>
				<div class="col-lg-4">
					<h3>Book Information</h3>
					<p><br/>
						<img src="<?php echo 'book_cover/'.$current['book_cover']; ?>" style="width:140px; height:140px; margin-bottom:5px"/><br/>
						Book Title : <b><?php echo $current['book_title']; ?></b> <br/>
						Book ID : <b><?php echo $current['book_id']; ?></b> <br/>
						Author : <b><?php echo $auth['given_name'].' '.$auth['sur_name']; ?></b> <br/>
						Book Description : <b><?php echo $current['book_content']; ?></b> <br/>
						Field : <b><?php echo $current2['field']; ?></b> <br/>						
					</p>
				</div>	
				<div class="col-lg-4">
					<h3>Edit Current Project</h3>
					<p><p>
						<form action="index.php?edit=<?php echo $current['book_id']; ?>" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="book_title" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="book_title" <?php echo 'value="' .$current['book_title'].'"'; ?> required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="book_content" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <input type="text" class="form-control" name="book_content" <?php echo 'value="' .$current['book_content'].'"'; ?> required>
						    </div>
						  </div>						  						  
						  <div class="form-group">
						    <div class="col-lg-10">
						      <button type="submit" name="update" class="btn btn-success">Update</button>
						    </div>
						  </div>
					   </form>
					</p>
				</div>

				
				<div class="col-lg-4">
					<h3>Existing Projects</h3>
					<p>
					<?php
		$user = $_SESSION['user'];
		$sql = "SELECT * FROM `users` WHERE `user_name`='$user'";
		$query = mysql_query($sql)or die(header("location:error_occur.php"));
		$current = mysql_fetch_assoc($query);					
						$user_id = $current['user_id'];
						$sql = "SELECT * FROM `books` WHERE `author_id`='$user_id' ORDER BY `book_id` DESC";
						$query = mysql_query($sql)or die(header("location:error_occur.php"));
						while($proj = mysql_fetch_array($query))
					{
					?>
						<h5 class="proj"><a href="index.php?book_id=<?php echo $proj['book_id'];?>"><span class="icon icon-pushpin"></span><?php echo ' ' . $proj['book_title'];?></a><a href="index.php?delete=<?php echo $proj['book_id'];?>"><span class="icon icon-cancel-circle" style="float:right;padding-left:10px"> Delete</span></a></h5>
						<span class="icon-small icon-calendar"><?php echo ' ' . $proj['date'];?></span><br/>
					<?php
					}						
					?>
					</p>					
				</div><!-- col -->
			</div>
		
		</div>