<?php

$Name = $Email ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //sanitise input for XSS
  $Name = test_input($_POST["Name"]);
  $Email = test_input($_POST["Email"]);
  //Create log file of users. You can enter the same in a db as well 
  // NOTE: This is logged to /tmp not to the web root.
  $handle = fopen(sys_get_temp_dir() . "/log.txt", "a");
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
<div style="display: flex; justify-content: center;">
<br />
<?PHP
$header  = array('http' => array('user_agent' => 'BSL'));
$baglam  = stream_context_create($header);

$cek = json_decode(@file_get_contents('https://haveibeenpwned.com/api/v2/breachedaccount/' . urlencode($Email), false, $baglam), true);
=======
$lim=0;
$lim = (@count($cek)>5)?5:@count(cek);

if(@count($cek) > 0){
  echo "<br><div style= 'font:calibri;color:black;align:center;size:50pt'>This email account has been compromised as the following sites were hacked. Change your password immediately.</style></br>";
  for($i=0; $i<$lim; $i++){
    echo "<div style= 'font:courier;color:black;align:center;size:30pt'><li>".$cek[$i]['Domain']."</li></style>";
  }
  //echo "<br><div style= 'font:calibri;color:white;align:center;size:30pt'>Dont forget to change your passwords!</style></br>";
}
else{
  echo "<div style= 'font:courier;color:black;align:center'>Huh! It seems to your informations are not leaked.</style>";
}

?>

