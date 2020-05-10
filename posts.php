<?php 
 include 'header.php';
?>
<div class="container">
	<div class="card shadow mt-2 mb-3">
		<div class="card-body">
			<h1 class="text-center" style="font-weight: bold;">All Posts</h1><hr>
			<div id="postsHere">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
		// API CALL TO FETCH All Posts
		fetch('/backend/API/?fetchAllPosts')
	        .then(
	          function(response) {
	            if (response.status !== 200) {
	              console.log('Looks like there was a problem. Status Code: ' +
	                response.status);
	              return;
	            }
	              response.json().then(function(data) {
	              	console.log(data);
	              	document.getElementById('postsHere').innerHTML = data.data;
	            });
	          }
	        )
	        .catch(function(err) {
	          console.log('Fetch Error :-S', err);
       	 });

	};
</script>