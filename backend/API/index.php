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

if (isset($_GET['fetchSingleUserPosts'])) {
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
    	}else{
    		$data = '<div class="alert alert-warning">No Posts!</div>';
    	}
    }

	$myObj = new stdClass();
	$myObj->data = $data;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}

if (isset($_GET['fetchSinglePost'])) {
	$postId = $_GET['postId'];
    $data = "";
	$sql = "SELECT * FROM POSTS WHERE ID = '$postId'";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	if(mysqli_num_rows($result)>0){
    		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    		$postSubject = $row["POST_SUBJECT"];
    		$postText = $row["POST_TEXT"];
    	}else{
    		$data = '<div class="alert alert-warning">Error Occured!</div>';
    	}
    }

	$myObj = new stdClass();
	$myObj->postSubject = $postSubject;
	$myObj->postText = $postText;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}

if (isset($_GET['fetchAllPostsAdmin'])) {
	$userId = $_SESSION['userId'];
    $data = "";
	$sql = "SELECT * FROM POSTS ORDER BY ID DESC";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	if(mysqli_num_rows($result)>0){
    		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	    		$data .= '<div>
					<h4 style="font-weight: bold;">'.$row["POST_SUBJECT"].'</h4>
					<h4>'.$row["POST_TEXT"].' </h4>
					<p style="font-weight: bold;">Post By:- '.$row["USER_NAME"].'</p>
					<div class="btn-group" role="group" aria-label="Basic example">';
				if ($row["USER_ID"] == $userId) {
					$data .= '<button type="button" id="updateBtn" class="btn btn-warning" onclick="update('.$row["ID"].')">Update</button>';
				}
					 
					$data .= '<button type="button" class="btn btn-danger" onclick="deletePost('.$row["ID"].')">Delete</button>
					</div>
				</div><hr>';
			}
    	}else{
    		$data = '<div class="alert alert-warning">No Posts!</div>';
    	}
    }

	$myObj = new stdClass();
	$myObj->data = $data;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}

//FETCH ALL POSTS

if (isset($_GET['fetchAllPosts'])) {
    $data = "";
	$sql = "SELECT * FROM POSTS ORDER BY ID DESC";
    $result = mysqli_query($link,$sql);
    if ($result) {
    	if(mysqli_num_rows($result)>0){
    		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	    		$data .= '<div>
					<h4 style="font-weight: bold;">'.$row["POST_SUBJECT"].'</h4>
					<h4>'.$row["POST_TEXT"].' </h4>
					<p style="font-weight: bold;">Post By:- '.$row["USER_NAME"].'</p>
				</div><hr>';
			}
    	}else{
    		$data = '<div class="alert alert-warning">No Posts!</div>';
    	}
    }

	$myObj = new stdClass();
	$myObj->data = $data;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}

if (isset($_GET['fetchNumbers'])) {
    $data = "";
	$sqlPosts = "SELECT * FROM POSTS";
	$sqlUsers = "SELECT * FROM USERS";
    $resultPosts = mysqli_query($link,$sqlPosts);
    $resultUsers = mysqli_query($link,$sqlUsers);
    if ($resultPosts) {
    	$numPosts = mysqli_num_rows($resultPosts);
    }
    if ($resultUsers) {
    	$numUsers = mysqli_num_rows($resultUsers);
    }

	$myObj = new stdClass();
	$myObj->users = $numUsers;
	$myObj->posts = $numPosts;
	$myJSON = json_encode($myObj);
	echo $myJSON;
}


// Update

if (isset($_GET['updatePost'])) {
	$postId = $_POST['postId'];
	$postText = $_POST['postText'];
	$postSubject = $_POST['postSubject'];

	$sql = "UPDATE POSTS SET POST_SUBJECT = '$postSubject' , POST_TEXT = '$postText' WHERE ID='$postId'";
	$result = mysqli_query($link,$sql);
   
	if ($result) {
		$data = 'Successfully Updated the post';
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

