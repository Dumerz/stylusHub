  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
  	<?php
  		include_once("components/header.php");

  		if(isset($_GET['sign_up'])){
  			include_once("components/signup.php");
			}
      elseif(isset($_SESSION['user'])){
          if(isset($_GET['log_out'])){
            unset($_SESSION['user']);
            unset($_SESSION['field_id']);
            unset($_SESSION['book_id']);
            header("location:index.php");
          }
          elseif(isset($_GET['user_edit'])){
            include_once("components/user_edit.php");
          }
          elseif(isset($_GET['book_id'])){
          if($_SESSION['field_id']==1){
            include_once("components/book_devt2.php");
          }
          else{
            include_once("components/book_devt.php");
          }
          }
          elseif(isset($_SESSION['field_id'])){
          if($_SESSION['field_id']==1){
            include_once("components/home2.php");
          }
          else{
            if(isset($_GET['edit'])){
            include_once("components/book_setting.php");
            }
            else
            include_once("components/home.php");
          }           
          }                                               
      }            
		  else{
  			include_once("components/login.php");
			}
  		include_once("components/footer.php");  		
  	?>
  </body>