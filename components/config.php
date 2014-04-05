<?php
mysql_connect("127.0.0.1","root","")or die(header("location:error_occur.php"));
mysql_select_db("stylushub")or die(header("location:error_occur.php"));
?>