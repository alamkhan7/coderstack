<?php 

function upload_image($imageFile, $storeImageName , $storedLocation){

	// echo "<pre>";
	// print_r($imageFile);
	// echo "<pre>";

	$imageStatus = array('imageName' => NULL, 'savedLocation' => NULL ,'Error' => NULL );

   	if (isset($imageFile['input-photo']['name'])){

		/* if file is image then type will be = image/jpeg */
		$image_type = $imageFile['input-photo']['type'] ;

	
		// getting image name = $imageFile['input-photo']['name']
		$imageName = $imageFile['input-photo']['name'] ;

		/* getting file extension e.g jpg */
		$extension = strtolower(substr($imageName, strpos($imageName, '.') + 1)) ;

	 	/* 
	   		when file is uploaded it store in server temporary location so we get the file from that temp location 
	 	*/
		$temp_location = $imageFile['input-photo']['tmp_name'] ;
	    
		if ( ($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif') && $image_type == 'image/jpeg'){

			// set image name with student name and extension e.g Snail.jpg
      		$imageStatus['imageName'] = $storeImageName .".". $extension ;

      		/* append file name with location and image name with extension */  
      		if (move_uploaded_file($temp_location, $storedLocation.$imageStatus['imageName']) ){
      			/* Save the file location in database */
        		$imageStatus['savedLocation'] = $storedLocation.$imageStatus['imageName'] ;
        	}
        	else{
        		$imageStatus['Error'] = "Error: Store location!" ;
        	}
     	}
      	else{ 
        	$imageStatus['Error'] = "Error: Photo extension not valid!";
      	}
    }
	else{
		$imageStatus['Error'] = "Error: No photo select!";
	}

	return $imageStatus ;
}

function get_new_auth_id(){

	$authStatus = array('newAuthID' => NULL, 'Error' => NULL );

 	$query = "SELECT MAX(authID)+1 AS newAuthID  FROM `authentication`";
	
	// Return array('queryResult' => NULL, 'Error' => NULL ); 
 	$queryResult = query_result($query) ;

 	if ($queryResult['Error'] == NULL){

    	$codeRow = mysqli_fetch_assoc($queryResult['queryResult']);
    	$authStatus['newAuthID'] = $codeRow['newAuthID'] ;
    	
    	if ($authStatus['newAuthID'] == 0)
      		$authStatus['newAuthID'] += 1 ;
 	}
 	else{
  		$authStatus['Error'] = "Sorry: Geeting new authentication id!";
 	}

 	//  Free result set
 	mysqli_free_result($queryResult['queryResult']);
 
 	return $authStatus ;
}

function query_result ($query){
	include './connection_inc.php';

	$queryResult = array('queryResult' => NULL, 'Error' => NULL );

	$queryResult['queryResult']  = mysqli_query($conn,$query) ;

	if (!$queryResult['queryResult']){
		$queryResult['Error'] = "\nError: Geeting query resource! " . mysqli_error($conn);
 	}

 	
 	//  close database connection
 	mysqli_close($conn);

 	return $queryResult ;
}

function password_matching($password , $re_password){
	$password = strtolower($password);
	$re_password = strtolower($re_password);
	if ($password===$re_password)
		return True ;
	else
		return False ;
}

function get_location_id($countryID,$stateID){
	include './connection_inc.php';
	$location = array('locationID' => NULL, 'Error' => NULL);

	$query = "SELECT locationID FROM location WHERE countryID='$countryID' AND stateID='$stateID' ";

	$queryResult = query_result($query) ;


    if ($queryResult['Error']==NULL){
 
    	if (mysqli_num_rows($queryResult['queryResult']) > 0){
    		
    		$record = mysqli_fetch_assoc($queryResult['queryResult']) ;
    		$location['locationID']  = $record['locationID'];
    	}
    	else{
    		$location['Error'] = "\nSorry: Location not found in database! ";
    	}
	}
	else{
		$location['Error'] = "\nError: Geeting location resource! " . mysqli_error($conn);
	}

	return $location ;
}
?>