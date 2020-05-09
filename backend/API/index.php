<?php 
session_start(); 
include '../config.php';

// Read

if (isset($_GET['fetchDetails'])) {
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM USERS WHERE ID = '$userId'";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    	$userName = $row['NAME'];
    	$userType = $row['TYPE'];
    	if ($userType == 'GEN_USER') {
    		$userType = "General User";
    	}
    	$email = $row['EMAIL'];
    	$phone = $row['PHONE'];
    	$myObj = new stdClass();
		$myObj->name = $userName;
		$myObj->email = $email;
		$myObj->phone = $phone;
		$myObj->userType = $userType;
		$myObj->error = null;
		$myJSON = json_encode($myObj);
		echo $myJSON;
    }else{
    	$myObj = new stdClass();
		$myObj->error = "Sorry No data!";
		$myJSON = json_encode($myObj);
		echo $myJSON;
    }

}

// Create

if (isset($_GET['createPost'])) {
	$userId = $_SESSION['userId'];
	$userName = $_POST['userName'];
	$postText = $_POST['postText'];
    $stmt = $link->prepare("INSERT INTO POSTS (`USER_ID`, `USER_NAME`, `POST_TEXT`)VALUES(?, ?, ?)");

	$stmt->bind_param("sss", $userId, $userName, $postText);

	$result = $stmt->execute();
	if ($result) {
		$data = 'success';
		$myObj = new stdClass();
		$myObj->data = $data;
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}else{
		$myObj = new stdClass();
		$myObj->error = "Sorry!";
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}

}

if (isset($_GET['fetchPosts'])) {
	$userId = $_SESSION['userId'];
    $data = "";
	$sql = "SELECT * FROM POSTS WHERE USER_ID = '$userId'";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    		$data = '<div>
				<h3 style="font-weight: bold;">Posts By:- '.$row["USER_NAME"].'</h3>
				<h4 style="font-weight: bold;">Subject:- </h4>
				<p> </p>
				<div class="btn-group" role="group" aria-label="Basic example">
				 <button type="button" class="btn btn-warnign" onclick="updatePost()">Update</button>
				 <button type="button" class="btn btn-danger" onclick="deletePost()">Update</button>
				</div>
			</div>';
    	}
    }

	if ($result) {
		$data = 'success';
		$myObj = new stdClass();
		$myObj->data = $data;
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}else{
		$myObj = new stdClass();
		$myObj->error = "Sorry!";
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}

}


?>

