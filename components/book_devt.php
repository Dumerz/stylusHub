	<?php
		$echo1 = "Wite your Commit in the Book";
		$user = $_SESSION['user'];
		$book_id = $_GET['book_id'];
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

		if(isset($_POST['submit']))
		{
				$line = $_POST['line'];
				$line = addslashes($line);
				$line = strip_tags($line);
				$book_id = $current['book_id'];
				$date = date("Y/m/d");
				$tempFile = $_FILES['upload']['tmp_name'];
				$targetFile =  $_FILES['upload']['name'];  
				move_uploaded_file($tempFile,"attachment/".$targetFile);						
		    mysql_query(" INSERT INTO `timeline`(`line`,`date`,`book_id`,`user_id`,`attach`)VALUES('$line','$date','$book_id','$user_id','$targetFile') ")or die(header("location:error_occur.php"));
		}

				$sql = "SELECT * FROM `books` WHERE `author_id`='$user_id' ORDER BY `date` DESC";
				$query = mysql_query($sql)or die(header("location:error_occur.php"));
				while($proj = mysql_fetch_array($query))
				$book_id = $_SESSION['book_id'];

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
					<h3>Timeline of <b><?php echo $current['book_title']; ?></b></h3>
					<p><p>
				<?php
					$sql2 = "SELECT * FROM `timeline` WHERE `book_id`='$book_id'";
					$query2 = mysql_query($sql2)or die(header("location:error_occur.php"));	
						while($proj2 = mysql_fetch_array($query2))
						{
							$user_id = $proj2['user_id'];
							$sql3 = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
							$query3 = mysql_query($sql3)or die(header("location:error_occur.php"));
							$proj3 = mysql_fetch_array($query3);							
							echo '<div class="col-lg-10" style="padding-left:0;margin-bottom:10px"><img src="user_image/'.$proj3['user_image'].'" style="width:20%;float:left;padding-right:10px;"/><span style="font-weight:bold;font-size:11px">'.$proj3['given_name'].' '.$proj3['sur_name'].'</span><br/>'.$proj2['line'].'<a href="attachment/'.$proj2['attach'].'"><span class="icon icon-bubble-paperclip" style="float:right"></span></a><br/><span style="font-size:11px;font-weight:bold">'.$proj2['date'].'</span><br/></div>';
						}
							
				?>		

						<form action="index.php?book_id=<?php echo $book_id;?>" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="book_title" class="col-lg-4 control-label"></label>
						    <div class="col-lg-10">
						      <img src="<?php echo 'user_image/'.$current1['user_image']; ?>" style="width:20%;float:left"/>
						      <input type="text" class="form-control" style="width:60%;height:9.5%;float:left" name="line" <?php echo 'placeholder="' .$echo1.'"'; ?> required>
						      <span class="icon icon-upload-3" style="width:20%;height:9.5%;float:left;overflow:hidden;font-size:30px;padding:10px;border: solid 1px #999"><input type="file" name="upload" style="position:absolute;top:0;padding:20px;opacity:0;overflow:hidden" required/></span>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-lg-10">
						      <button type="submit" name="submit" style="display:none"class="btn btn-success">Create</button>
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
						<h5 class="proj"><a href="index.php?book_id=<?php echo $proj['book_id'];?>"><span class="icon icon-pushpin"></span><?php echo ' ' . $proj['book_title'];?></a><a href="index.php?delete=<?php echo $proj['book_id'];?>"><span class="icon icon-cancel-circle" style="float:right;padding-left:10px"> Delete</span></a><a href="index.php?edit=<?php echo $proj['book_id'];?>"><span class="icon icon-pencil" style="float:right;padding-left:10px"> Edit</span></a></h5>
						<span class="icon-small icon-calendar"><?php echo ' ' . $proj['date'];?></span><br/>
					<?php
					}						
					?>
					</p>					
				</div><!-- col -->
			</div>
		
		</div>