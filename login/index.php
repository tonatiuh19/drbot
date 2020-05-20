<?php
// define variables and set to empty values
session_start();
require_once('../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = test_input($_POST["email_i"]);
	$pwd = test_input($_POST["pwd_i"]);


	$todayVisit = date("Y-m-d H:i:s");

	$sql = "SELECT email, name, last_name FROM users WHERE email='$email' AND pwd='$pwd'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
		while($row = $result->fetch_assoc()) {
			$_SESSION["email"] =	$row["email"];
			
			if (isset($_SESSION['email'])){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='../dashboard/';
					</SCRIPT>");
			}
			/*if ($row["type"]==2) {
				if ($row["active"]==0) {
					echo "<form action=\"../sign-up/verify/\" id=\"my_form\" method=\"post\">\n";
					echo "  <input type=\"hidden\" name=\"project\" value=\"".$row["email"]."\">\n";
					echo "<input type='submit' name='btnSignIn' value='Wait...' id='btnSignIn' />\n";
					echo "</form>\n";
					echo "<script type=\"text/javascript\">\n";
					echo "    document.getElementById('btnSignIn').click();\n";
					echo "</script>\n";
				}else{
					$_SESSION["email"] =	$row["email"];
					$_SESSION["type_user"] =	$row["type"];
					if (isset($_SESSION['email'])){
						echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../dashboard/';
							</SCRIPT>");
					}
				}

			}*/

		}
	} else{
		/*echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('El email y contraseña que escribiste no coinciden')
			window.location.href='../';
			</SCRIPT>");*/
	}


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
