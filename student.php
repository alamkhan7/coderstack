<?php
include ('./script/connection_inc.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Coders Stack</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="blurBg-true" style="background-color:#EBEBEB">



<!-- Start Formoid form-->
<link rel="stylesheet" href="student_files/formoid1/formoid-solid-blue.css" type="text/css" />
<script type="text/javascript" src="student_files/formoid1/jquery.min.js"></script>

<form enctype="multipart/form-data" class="formoid-solid-blue" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:1000px;min-width:250px" method="post" action="./script/student_reg.php">
	<div class="title">
		<h2>Student Sign Up</h2>
	</div>
	<div class="element-name" title="User Name"><label class="title"><span class="required">Name</span></label><span class="nameFirst"><input placeholder="First Name" type="text" size="8" name="name[first]" required="required"/><span class="icon-place"></span></span><span class="nameLast"><input placeholder="Last Name" type="text" size="14" name="name[last]" required="required"/><span class="icon-place"></span></span>
	</div>
	<div class="element-email" title="Enter E-mail">
		<label class="title">
			<span class="required">Email</span>
		</label>
		<div class="item-cont">
			<input class="large" type="email" name="email" value="" required="required" placeholder="Email"/>
			<span class="icon-place">
			</span>
		</div>
	</div>
	<div class="element-password" title="Passwaord">
		<label class="title">
			<span class="required">Password</span>
		</label>
		<div class="item-cont">
			<input class="large" type="password" name="password" value="" required="required" placeholder="Password"/>
			<span class="icon-place">
			</span>
		</div>
	</div>
	<div class="element-password">
		<label class="title">
			<span class="required">Re-Enter Password</span>
		</label>
		<div class="item-cont">
			<input class="large" type="password" name="re-password" value="" required="required" placeholder="Re-enter password"/>
		<span class="icon-place"></span>
	</div>
</div>

	<div class="element-phone" title="Contact Number">
		<label class="title">
			<span class="required">Contact</span>
		</label><div class="item-cont">
		<input class="large" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="24" name="phone" required="required" placeholder="Contact" value=""/>
		<span class="icon-place">
		</span>
	</div>
</div>
	<div class="element-address">
		<label class="title">
			<span class="required">Address:</span></label><span class="addr1"><input placeholder="Present Address" type="text" name="address[present]" required="required"/><span class="icon-place"></span></span><span class="addr2"><input placeholder="Permanent Address" type="text" name="address[permanent]" /><span class="icon-place"></span></span><span class="city"><input placeholder="City" type="text" name="address[city]" /><span class="icon-place"></span></span><span class="state"><input placeholder="State / Province" type="text" name="address[state]" required="required"/><span class="icon-place"></span></span><span class="zip"><input placeholder="Postal / Zip Code" type="text" maxlength="15" name="address[zip]" required="required"/><span class="icon-place"></span></span><div class="country">
			<select name="address[country]" required="required"><option selected="selected" value="" disabled="disabled">--- Select a country ---</option>
			<?php
				$query = "SELECT countryID, name , phonecode FROM countries";

			    if ( $queryResult = mysqli_query($conn,$query) ){
			        while ( $row = mysqli_fetch_assoc($queryResult) ){
				        $countryName = $row['name'];
				        $phoneCode = $row['phonecode'];
				        $countryID = $row['countryID'] ;
				        $display = $countryName . " (+" . $phoneCode . ")" ; 
				        echo  '<option value="'.$countryID.'"> '.$display. '</option>';
				    }
			    }		
			?>
			</select><i></i><span class="icon-place"></span></div></div>

	<div class="element-input" title="Enter Qualification">
		<label class="title">
			<span class="required">Qualification:</span>
		</label>
		<div class="item-cont">
			<input class="large" type="text" name="qualification" required="required" placeholder="Qualification"/>
			<span class="icon-place">
			</span>
		</div>
	</div>
	<div class="element-input"><label class="title">
		<span class="required">Institute Name:</span>
	</label>
	<div class="item-cont">
		<input class="large" type="text" name="institute" required="required" placeholder="Institute Name"/>
		<span class="icon-place">
		</span>
	</div>
</div>
	<div class="element-multiple" title="Skills"><label class="title"><span class="required">Skills:</span></label><div class="item-cont"><div class="large"><select data-no-selected="Select Skills" name="skills[]" multiple="multiple" required="required">

		<option value="Web Designing">Web Designing</option>
		<option value="Android">Android</option>
		<option value="C/C++">C/C++</option>
		<option value="Graphic Designing	">Graphic Designing	</option>
		<option value="Game Development">Game Development</option>
		<option value="Others">Others</option></select><span class="icon-place"></span></div></div></div>
	<div class="element-input"><label class="title"> <span class="">Experience:</span></label> <div class="item-cont"><input class="large" type="text" name="experience" placeholder="Experience"/><span class="icon-place"></span></div></div>
	<div class="element-radio" title="Specify Gender">
		<label class="title">Gender: 
			<span class="required">
			</span>
		</label>		
		<div class="column column2"><label><input type="radio" name="gender" value="Male" required="required"/><span>Male</span></label></div><span class="clearfix"></span>
		<div class="column column2"><label><input type="radio" name="gender" value="Female" required="required"/><span>Female</span></label></div><span class="clearfix"></span>
</div>

	<div class="element-file"><label class="title"></label><div class="item-cont"><label class="large" ><div class="button">Choose File</div>
	<input type="file" accept="image/png, image/jpeg, image/gif" class="file_input" name="input-photo" />
	<div class="file_text">Upload Photo</div><span class="icon-place"></span></label></div></div>
<div class="submit"><input type="submit" name="submit" value="Submit"/></div></form>
<script type="text/javascript" src="student_files/formoid1/formoid-solid-blue.js"></script>
<!-- Stop Formoid form-->



</body>
</html>
