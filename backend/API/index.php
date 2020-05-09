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
	$postSubject = $_POST['postSubject'];
    $stmt = $link->prepare("INSERT INTO POSTS (`USER_ID`, `USER_NAME`, `POST_SUBJECT`, `POST_TEXT`)VALUES(?, ?, ?, ?)");

	$stmt->bind_param("ssss", $userId, $userName, $postSubject, $postText);

	$result = $stmt->execute();
	if ($result) {
		$data = 'Successfully Created a post';
		$myObj = new stdClass();
		$myObj->msg = $data;
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}else{
		$myObj = new stdClass();
		$myObj->error = "Sorry!";
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}

}

// Read

if (isset($_GET['fetchPosts'])) {
	$userId = $_SESSION['userId'];
    $data = "";
	$sql = "SELECT * FROM POSTS WHERE USER_ID = '$userId' ORDER BY ID DESC";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	if(mysqli_num_rows($result)>0){
    		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	    		$data .= '<div>
					<h4 style="font-weight: bold;">'.$row["POST_SUBJECT"].'</h4>
					<h4>'.$row["POST_TEXT"].' </h4>
					<p style="font-weight: bold;">Post By:- '.$row["USER_NAME"].'</p>
					<div class="btn-group" role="group" aria-label="Basic example">
					 <button type="button" id="updateBtn" class="btn btn-warning" onclick="update('.$row["ID"].')">Update</button>
					 <button type="button" class="btn btn-danger" onclick="deletePost('.$row["ID"].')">Delete</button>
					</div>
				</div><hr>';
			}
    	}
    }

	$myObj = new stdClass();
	$myObj->data = $data;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}

// Delete

if (isset($_GET['deletePost'])) {
	$postId = $_POST['postId'];
    $sql = "DELETE FROM POSTS WHERE ID='$postId'";
	$result = mysqli_query($link,$sql);
	if ($result) {
		$data = 'Successfully Deleted a post';
		$myObj = new stdClass();
		$myObj->msg = $data;
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

