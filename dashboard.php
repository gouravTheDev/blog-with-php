<?php 
 include 'header.php';
?>
<div class="container mt-2" onload="callMF()">
	<div class="alert alert-warning" id="warning" style="display: none;">Sorry! No data!</div>
	<div class="card shadow">
		<div class="card-body">
			<h1 class="text-center">User Dashboard</h1><br>
			<table class="table table-bordered col-md-8 mx-auto">
				<tr>
					<th>User Name:-</th>
					<td id="userName"></td>
				</tr>
				<tr>
					<th>User Type:-</th>
					<td id="userType"></td>
				</tr>
				<tr>
					<th>Phone:-</th>
					<td id="phone"></td>
				</tr>
				<tr>
					<th>Email:-</th>
					<td id="email"></td>
				</tr>
			</table>
			<hr>
			<div class="alert alert-success" id="successPost" style="display: none;">Post created Successfully</div>
			<form>
				<h3 style="font-weight: bold;">Create a Post</h3>
				<textarea class="form-control" cols="4" id="postText" placeholder="Write Something"></textarea><br>
				<button type="button" onclick="createPost();" class="btn btn-success" >Create</button>
			</form><br>
			<h1 class="text-center">My Posts</h1>
			<div id="postsHere"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
		// API CALL TO FETCH USER DATA
		fetch('/backend/API/?fetchDetails')
	        .then(
	          function(response) {
	            if (response.status !== 200) {
	              console.log('Looks like there was a problem. Status Code: ' +
	                response.status);
	              return;
	            }
	              response.json().then(function(data) {
		              if (data.error == null) {
		              	document.getElementById('userName').innerHTML = data.name;
		              	document.getElementById('userType').innerHTML = data.userType;
		              	document.getElementById('phone').innerHTML = data.phone;
		              	document.getElementById('email').innerHTML = data.email;
		              	fetchPosts();
		              }else{
		              	document.getElementById('warning').style.display = "block";
		              }
	            });
	          }
	        )
	        .catch(function(err) {
	          console.log('Fetch Error :-S', err);
       	 });

	};

	// Function to Create Post

	function createPost() {
		var postText = document.getElementById('postText').value;
		var userName = document.getElementById('userName').innerHTML;
		let formData = new FormData();
      	formData.append('postText', postText);
      	formData.append('userName', userName);
		
		// API CALL TO SUBMIT DATA

		fetch("/backend/API/?createPost", {
            method: "POST",
            body:formData,
        }).then(
            function(response) {
            response.json().then(function(data) {
              console.log(data);
            });
          }
        )
        .catch(function(err) {
          console.log('Fetch Error :-S', err);
        });

	}

	function fetchPosts() {
		body...// API CALL TO FETCH USER POSTS

		fetch('/backend/API/?fetchPosts')
	        .then(
	          function(response) {
	            if (response.status !== 200) {
	              console.log('Looks like there was a problem. Status Code: ' +
	                response.status);
	              return;
	            }
	              response.json().then(function(data) {
		              if (data.error == null) {
		              	document.getElementById('userName').innerHTML = data.name;
		              	document.getElementById('userType').innerHTML = data.userType;
		              	document.getElementById('phone').innerHTML = data.phone;
		              	document.getElementById('email').innerHTML = data.email;
		              }else{
		              	document.getElementById('warning').style.display = "block";
		              }
	              // var dataToshow = document.getElementById('detailsHere');
	              // dataToshow.innerHTML = '';
	              // dataToshow.innerHTML = data.data;
	            });
	          }
	        )
	        .catch(function(err) {
	          console.log('Fetch Error :-S', err);
       	 });
	}
</script>