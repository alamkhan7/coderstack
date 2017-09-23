<?php
include ('./connection_inc.php');
include_once ('./function_inc.php');

 //echo "<pre>";
 //print_r($_POST);
 //echo "<pre>";

 echo "<pre>";
 print_r($_FILES);
 echo "<pre>";

//$going_back = '../add_emp.php' ;
//$Error = '';
//$Label = '' ;


if (isset($_POST['input3']));

{
//echo 'entered into post and is submitted';

$input3= $_POST['input3'];

$email=$_POST['email'];
//echo $email ; 
//$re-password=$_POST['re-password'];

// echo "password/n";
$password=$_POST['password'];
// echo $password;



// echo "repassword/n";
$repassword=$_POST['repassword'];
// echo $repassword; 

$phone=$_POST['phone'];
// echo $phone;

$address=$_POST['address'];

$url=$_POST['url'];

//echo 'hello111111';
$textarea=$_POST['textarea'];

$image = $_FILES ;
$StoredImageName1 = $input3 ;
$storedLocation1 = '../student_files/Uploaded_Photos/' ;


 
    if (password_matching($password,$repassword) ){

        //echo 'helllo password is matched ';
                
       	$imageStatus1 = upload_image($image,$StoredImageName1,$storedLocation1) ;
       	if ($imageStatus1['Error'] == NULL){
       	}
       	else{
       		echo $message = $imageStatus1['Error'];
       	}
    }
   	else{
		echo $message = "Error: Password not match!";
    }
       	

      	

//}

}
?>