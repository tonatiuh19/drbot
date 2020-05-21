<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $file = test_input($_POST["file"]);

  $folder_path = "../user/".$_SESSION['email']."/delete";
  if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
  }
  $filename = substr($file, strrpos($file, '/') + 1);
  rename("../".$file, $folder_path."/".$filename);
  echo ("<SCRIPT LANGUAGE='JavaScript'>
     window.location.href='../';
     </SCRIPT>");

}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
     window.location.href='../';
     </SCRIPT>");
  }


  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

?>
