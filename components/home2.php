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
		if(isset($_GET['abort'])){
							$abort = $_GET['abort'];
							$sql1 = "UPDATE `books` SET editor_id = '0' WHERE `book_id`= '$abort'";
							$query1 = mysql_query($sql1)or die(header("location:error_occur.php"));
							header("location:index.php?home");
						}
  		if(isset($_GET['editor_book'])){
  			$editor_book = $_GET['editor_book'];
  			$user_id = $current['user_id'];
  			mysql_query(" UPDATE books SET editor_id = '$user_id' WHERE book_id = '$editor_book'")or die(header("location:error_occur.php"));
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
					<h3>Project Queue</h3>
					<p>
					<?php
						$sql = "SELECT * FROM `books` WHERE `editor_id`='0' ORDER BY `book_id` DESC";
						$query = mysql_query($sql)or die(header("location:error_occur.php"));
						while($proj = mysql_fetch_array($query))
					{
					?>
						
						<h5 class="proj"><a href="index.php?editor_book=<?php echo $proj['book_id'];?>"><span class="icon icon-plus"></span></a><?php echo ' ' . $proj['book_title'];?></h5>
						<span class="icon-small icon-calendar"><?php echo ' ' . $proj['date'];?></span><br/>
					<?php
					}
					?>					   	
					</p>
				</div>
				
				<div class="col-lg-4">
					<h3>Existing Projects</h3>
					<p>
					<?php
						$user_id = $current['user_id'];
						$sql = "SELECT * FROM `books` WHERE `editor_id`='$user_id' ORDER BY `book_id` DESC";
						$query = mysql_query($sql)or die(header("location:error_occur.php"));
						while($proj = mysql_fetch_array($query))
					{
					?>
						<h5 class="proj"><a href="index.php?book_id=<?php echo $proj['book_id'];?>"><span class="icon icon-pushpin"></span><?php echo ' ' . $proj['book_title'];?></a><a href="index.php?abort=<?php echo $proj['book_id'];?>"><span class="icon icon-cancel-circle" style="float:right;padding-left:10px"> Abort</span></a></h5>
						<span class="icon-small icon-calendar"><?php echo ' ' . $proj['date'];?></span><br/>
					<?php
					}
					?>
					</p>					
				</div><!-- col -->
			</div>
		
		</div>