<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Seller Dashboard</title>
		<link href="dashboard.css" rel="stylesheet">
		<script>
			function openForm() {
				document.getElementsByTagName("form")[0].style.display = "table";
				document.getElementById("open").disabled = true;
			}
			function closeForm() {
				document.getElementsByTagName("form")[0].style.display = "none";
				document.getElementById("open").disabled = false;
			}
		</script>
	</head>
	<body>
		<nav class="header">
			<div class="header-image">
				<a href="homepage.html">
					<img src="img/logo4.png" alt="Homepage">
				</a>
			</div>
		</nav>
		<button id="open" onclick="openForm()">+</button>
		<form method="post" action="./dashboard.php" id="sellerForm">
			<div id="form-header">
				<h1>Add Property</h1>
				<button onclick="closeForm()" id="close">X</button>
			</div>
			<p>
				<label for="address">Address<span class="required">*</span>:</label>
				<input type="text" name="address" required /><br>
			</p>
			<p>
				<label for="city">City<span class="required">*</span>:</label>
				<input type="text" name="city" required /><br>
			</p>
			<p>
				<label for="state">State<span class="required">*</span>:</label>
				<input type="text" name="state" required /><br>
			</p>
			<p>
				<label for="zip">Zip<span class="required">*</span>:</label>
				<input type="text" name="zip" required /><br>
			</p>
			<p>
				<label for="price">Listing Price<span class="required">*</span>:</label>
				<input type="text" name="price" required /><br>
			</p>
			<p>
				<label for="beds">Number of Bedrooms<span class="required">*</span>:</label>
				<input type="text" name="beds" required /><br>
			</p>
			<p>
				<label for="baths">Number of Bathrooms<span class="required">*</span>:</label>
				<input type="text" name="baths" required /><br>
			</p>
			<p>
				<label for="age">Property Age:</label>
				<input type="text" name="age" /><br>
			</p>
			<p>
				<label for="acquisition">Acquisition Date:</label>
				<input type="date" name="acquisition" /><br>
			</p>
			<p>
				<label for="extra">Additional Details:</label>
				<textarea name="extra"></textarea><br>
				<input type="submit" name="submit" onsubmit="addProperty()" value="Submit" />
		</form>
		<div class="dashboard">
			<div class="card"></div>
		</div>
		<footer class="footer">
			<div class="footer-content">
				<div class="footer-sectio-logo">
					<img src="img/logo-white.png" style="width: 250px;">
					<div id="line" style="border-bottom: 1px solid white ;"></div>
				</div>
				<div class="footer-section-contact">
					<h2>Contact Us</h2>
					<p>Email: propertyworld@prtywrld.com</p>
					<p>Phone: +6789998212</p>
				</div>
				<div class="footer-section-links">
					<h2>Quick Links</h2>
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>
			</div>
		</footer>
		<div class="footer-bottom">
			&copy; 2024 Propery World. All rights reserved.
		</div>
	</body>
</html>