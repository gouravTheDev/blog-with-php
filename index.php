<?php
 include 'header.php';
?>
<div class="container mt-2">
	<h1 class="text-center" style="color: #192A56; font-weight:bold;">Welcome to Discussion Forum</h1>
	<div class="slideshow-container">
	<div class="mySlides fade">
	  <!-- <img src="images/attendance.jpg" style="width:100%; height: 500px;"> -->
	  <img src="images/slider1.jpg" style="width:100%; height: 500px;">
	</div>

	<div class="mySlides fade">
	  <img src="images/slider2.jpg" style="width:100%; height: 500px;">
	</div>

	<div class="mySlides fade">
	  <img src="images/slider3.jpg" style="width:100%; height: 500px;">
	</div>

	</div>
	<br>
	<div style="text-align:center">
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	</div>
	<hr>
	<div class="container">
		<div class="card shadow mt-2 mb-3">
			<div class="card-body">
				<h4 class="card-text">
					Welcome to discussion forum. Here you will be connected with millions of users and you will get all the posts they share daily. You can share your thoughts after registering yourself in this portal. You will gain knowledge and updates about the society in a daily basis. Please follow our guidelines while posting something in the portal otherwise yor post may be deleted by Admin. Register yourself now. Stay connected!
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="card text-white bg-success shadow p-2 mb-2">
					<div class="card-body text-center">
						<div class="card-text text-center">
							<img src="images/icon1.png" height="70" width="70">
							<h4 class="font-weight-bold">Total Posts</h4>
							<h5 class="font-weight-bold" id="totalPost"></h5>
						</div>
					</div>
				</div>
			</div>	
			<div class="col-md-6 col-sm-12">
				<div class="card text-white bg-dark shadow p-2 mb-2">
					<div class="card-body text-center">
						<div class="card-text">
							<img src="images/icon2.png" height="70" width="70">
							<h4 class="font-weight-bold">Total Users</h4>
							<h5 class="font-weight-bold" id="totalUser"></h5>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
	<br><br>
	</div>

	<script type="text/javascript">
		var slideIndex = 0;
		showSlides();
		fetchNumbers();

		function showSlides() {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("dot");
		  for (i = 0; i < slides.length; i++) {
		    slides[i].style.display = "none";  
		  }
		  slideIndex++;
		  if (slideIndex > slides.length) {slideIndex = 1}    
		  for (i = 0; i < dots.length; i++) {
		    dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " active";
		  setTimeout(showSlides, 3000); // Change image every 3 seconds
		}

		function fetchNumbers() {
			fetch('/backend/API/?fetchNumbers')
	        .then(
	          function(response) {
	            if (response.status !== 200) {
	              console.log('Looks like there was a problem. Status Code: ' +
	                response.status);
	              return;
	            }
	              response.json().then(function(data) {
	              	console.log(data);
	              	document.getElementById('totalUser').innerHTML = data.users;
	              	document.getElementById('totalPost').innerHTML = data.posts;
	            });
	          }
	        )
	        .catch(function(err) {
	          console.log('Fetch Error :-S', err);
       	 });
		}

	</script>
<script type="text/javascript" src="js/script.js"></script>
	


