<?php
   session_start();
   $id = $_SESSION['id'];
   $result2 = mysql_query ("UPDATE student  SET vacancy='$login' WHERE id='$id'");
   ?>