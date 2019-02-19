<?php

$Name = $Email ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //sanitise input for XSS
  $Name = test_input($_POST["Name"]);
  $Email = test_input($_POST["Email"]);
//Create log file of users. You can enter the same in a db as well 
  $handle = fopen("log.txt", "a");
   fwrite($handle, "EmpID=");
   fwrite($handle, $Name);
   fwrite($handle, "\n");
   fwrite($handle, "Email=");
   fwrite($handle, $Email);
   fwrite($handle, "\r\n");
}


fwrite($handle, "\r\n");
fclose($handle);
//exit;
//Sanitisation function
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!-- Api call for displaying the data -->
<?PHP
$header  = array('http' => array('user_agent' => 'Pwnage-Checker-For-iOS'));
$baglam  = stream_context_create($header);
$cek = json_decode(@file_get_contents('https://haveibeenpwned.com/api/v2/breachedaccount/'.$Email, false, $baglam), true);
if(@count($cek) > 0){
	echo "This email account was compromised in the following breaches:";
	for($i=0; $i<@count($cek); $i++){
		echo "<li>".$cek[$i]['Domain']."</li>";
	}
	echo 'Dont forget to change your passwords!';
}else{
	echo "Huh! It seems to your informations are not leaked.";
}

?>