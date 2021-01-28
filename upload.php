<?php

include("data/variables.php");
//mysql server connect (aborts script if no mysql-server connection can be made)
$con = mysqli_connect("$host","$username","$password");
if (!$con)
 {
die('Could not connect: ' . mysqli_error($con));
 }
 //select database
 mysqli_select_db($con, "$dbname");

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)
//and it will be changed to 1 if an error occures.
//If the error occures the file will not be uploaded.

$errors=0;

$ip = getRealIpAddr(); // Get the visitor's IP



//checks if the ip don't exists in the table and adds it
if(!mysqli_num_rows(mysqli_query($con, "SELECT ipadress FROM $tblname WHERE ipadress = '$ip'")))
{
$sql="INSERT INTO music (ipadress)
VALUES ('$ip')";

if (!mysqli_query($con, $sql))
 {
 $errors=1;
 die('Error: ' . mysqli_error($con));
 }

}


//checks counter in table if <$maxuploads
if(!mysqli_num_rows(mysqli_query($con, "SELECT * FROM music WHERE ipadress = '$ip' && counter<$maxuploads")))
{
$errors=1;
header("location: $mainsite?err=1");
}



//This function reads the extension of the file. It is used to determine if the file allowed by checking the extension.

function getExtension($str) {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
}

//checks if the form has been submitted
if(isset($_POST['Submit']))
{
     //reads the name of the file the user submitted for uploading
     $ulfile=$_FILES['file']['name'];
     //if it is not empty
     if ($ulfile)
     {
     //get the original name of the file from the clients machine
         $filename = stripslashes($_FILES['file']['name']);
     //get the extension of the file in a lower case format
         $extension = getExtension($filename);
         $extension = strtolower($extension);
     //if it is not a known extension, we will suppose it is an error and will not  upload the file,
//if (($extension != "mp3") && ($extension != "m4a") && ($extension != "ogg") && ($extension != "mid") && ($extension != "wma") && ($extension != "midi") && ($extension != "xm") && ($extension != "mod") && ($extension != "swf") && ($extension != "flv") && ($extension != "mp4") && ($extension != "mkv") && ($extension != "avi") && ($extension != "ape"))
if (!in_array($extension,$extvars))
{
$errors=1;
header("location: $mainsite?err=2");
return;
}
else
//Get filesize
$size=filesize($_FILES['file']['tmp_name']);


//compare filesize with $maxsize
if ($size > ($maxsize*(1024*1000)))
{
$errors=1;
header("location: $mainsite?err=3");
}
else


//checks if the file allready exist on server
    if (file_exists("musik/" . $_FILES['file']['name']))
      {
	  $errors=1;
header("location: $mainsite?err=4");
      }
	  else
{
//the new name contains the full path where the file will be stored
$newname="musik/".$filename;
//verifies if the file has been uploaded

$copied = copy($_FILES['file']['tmp_name'], $newname);

if (!$copied)
{
$errors=1;
header("location: $mainsite?err=5");
}}}}

//If no errors registred, print the success message
if(isset($_POST['Submit']) && !$errors)
{

//add "1" to counter
$result = mysqli_query($con, "SELECT * FROM music WHERE ipadress = '$ip'");

while($row = mysqli_fetch_array($result))
 {
 $plus = 1 + $row['counter'];
 mysqli_query($con, "UPDATE music SET counter = '$plus' WHERE ipadress = '$ip'");
 }

header("location: $mainsite?err=6&c=$plus");
}
else


//if(!mysql_num_rows(mysql_query("SELECT * FROM music WHERE ipadress = '$ip' && counter<$maxuploads")))


//closes the mysql connection
mysqli_close($con);



//functions
//gets client ip-adress and stores it on variable "$ip", will probably also work if behind a proxy
function getRealIpAddr() {
 if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip=$_SERVER['HTTP_CLIENT_IP']; // share internet
 } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; // pass from proxy
 } else {
    $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}
?>
