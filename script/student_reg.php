<?php
include ('./connection_inc.php');
include_once ('./function_inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "<pre>";

// echo "<pre>";
// print_r($_FILES);
// echo "<pre>";

$going_back = '../add_emp.php' ;
$Error = '';
$Label = '' ;

if (isset($_POST['submit'])){

	$firstName = $_POST['name']['first'] ;
	$lastName = $_POST['name']['last'] ;
	$email = $_POST['email'] ;
	$password = $_POST['password'] ;
	$re_password = $_POST['re-password'] ;
	$phone = $_POST['phone'] ;
	$present_address = $_POST['address']['present'] ;
	$permanent_address = $_POST['address']['permanent'] ;
	$city = $_POST['address']['city'] ;
	$state = $_POST['address']['state'] ;
	$zip = $_POST['address']['zip'] ;
	$country = $_POST['address']['country'] ;
	$qualification = $_POST['qualification'] ;
	$institute = $_POST['institute'] ;
	$skills = implode("," , $_POST['skills']) ;
	$experience = $_POST['experience'] ;
	$gender = $_POST['gender'] ;
	
	/*Define Image Parameter*/
	$image = $_FILES ;
	$StoredImageName = $firstName."_".$lastName ;
	$storedLocation = '../student_files/Uploaded_Photos/' ;

	// Note: empty array is falsey
	if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($re_password) && !empty($phone) && !empty($present_address) && !empty($permanent_address) && !empty($city) && !empty($state) && 
        !empty($zip) && !empty($country) && !empty($qualification) && !empty($institute) && !empty($experience) && 
        !empty($gender) && !empty($skills) ){
       	
       	/*  upload_image return array 
       		array('imageName' => NULL, 'savedLocation' => NULL ,'Error' => NULL ); 
       	*/

       	if (password_matching($password,$re_password) ){

       		$imageStatus = upload_image($image,$StoredImageName,$storedLocation) ;
	       	if ($imageStatus['Error'] == NULL){

	       		/*
	       			Getting new auth id for every new member and company 
	       			Functoin return array('newAuthID' => NULL, 'Error' => NULL )
	       		*/
	       		$authID = get_new_auth_id() ;

	       		if ($authID['Error'] == NULL){

	       			$newAuthID = $authID['newAuthID'] ;

	       			/* Store the authentication of user in authentication table */
	       			$query = "CALL add_authentication('$newAuthID', '$email', '$password')" ;
	       			/* $queryResult = array('queryResult' => NULL, 'Error' => NULL ) */
	       			$response = query_result($query);		
	        		
	        		/* If successful then add new record */
	  				if($response['Error'] == NULL){
		    			
		    			$imageLocation = $imageStatus['savedLocation'] ;
		    			/* $location = array('locationID' => NULL, 'Error' => NULL); */
		    			$location = get_location_id($country,$state) ;
		    			if ($location['Error'] == NULL){

		    				$locationID = $location['locationID'] ;

		    				$query = "CALL member_reg('$firstName','$lastName', '$gender', '$qualification', '$institute', '$experience', '$phone', '$imageLocation', '$email', '$present_address', '$permanent_address', '$newAuthID', '$city', '$locationID')" ;

			    			$response = query_result($query);
			    			
			    			if($response['Error'] == NULL){
			    				echo "student register done!" ;
			    			}
			    			else{
			    				echo $message['Error'] = $response['Error']; 
			    			}
		    			}
		    			else{
		    				echo $message['Error'] = $location['Error']; 
		    			}
		    			
		    		}
	  				else{
	    				echo $message['Error'] = $response['Error'];  
	  				}
	       		}
	       		else{
	       			echo $message = $authID['Error'] ;
	       		}

	       	}
	       	else{
	       		echo $message = $imageStatus['Error'];
	       	}
       	}
       	else{
       		echo $message = "Error: Password not match!";
       	}
       	

      	
    }
    else{
    	// Return error to page
        echo $message = "Please fill the form";
    }

}
else{
	echo "Empty Error!" ;
}

?>