<?php
session_start();
if (!isset($_SESSION["username"])) {
	header("Location: homepage.html");
	exit;
}

if (isset($_POST["signOut"])) {
	unset($_COOKIE["user"]);
	setcookie("user", "", -1, "/");
	unset($_SESSION["username"]);
	session_destroy();
	session_write_close();
	header("Location: homepage.html");
	exit;
}
function connect(){
	$servername = "localhost";
	$username = "hnguyen284";
	$password = "hnguyen284";
	$dbname = "hnguyen284";
	return new mysqli($servername, $username, $password, $dbname);
}

$address = $_POST['address'] . ", " . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'];
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = connect();
if($conn->connect_error) {
	die("connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS PROPERTYDATA (
	username VARCHAR(50),
	address VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
	state CHAR(2) NOT NULL,
	zip CHAR(5) NOT NULL,
	price VARCHAR(50) NOT NULL,
	beds INT NOT NULL,
	baths INT NOT NULL,
	age INT,
	acquiredDate DATE,
	extra VARCHAR(255)
	)";
if(!$conn->query($sql) === TRUE) {
	echo "Error creating table: " . $conn->error;
}
$conn->close();
function addProperty(){
	$SELLER = $_SESSION["username"];
	$conn = connect();
	if (isset($_POST["address"]) and isset($_POST["city"])
	and isset($_POST["state"]) and isset($_POST["zip"])
	and isset($_POST["price"]) and isset($_POST["beds"])
	and isset($_POST["baths"]) and isset($_POST["age"])
	and isset($_POST["acquisition"]) and isset($_POST["extra"])) {
		$street = $_POST["address"];
		$city = $_POST['city'];
		$state = $_POST["state"];
		$zip = $_POST["zip"];
		$price = $_POST["price"];
		$beds = $_POST["beds"];
		$baths = $_POST["baths"];
		$age = $_POST["age"];
		$acquisition = $_POST["acquisition"];
		$extra = $_POST["extra"];
	}
	$sql = "INSERT INTO PROPERTYDATA (username, address, city, state, zip, price, beds, baths, age, acquiredDate, extra) 
	VALUES (\"$SELLER\",\"$street\", \"$city\", \"$state\", \"$zip\", \"$price\", $beds, $baths, $age, \"$acquisition\", \"$extra\")";
	if($conn->query($sql) === TRUE){
		echo "working";
	} else {
		echo "Error inserting into table: " . $conn->error;
	}
	$conn->close();
}
if (isset($_POST["submit"])) {
	addProperty();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Seller Dashboard</title>
		<link href="dashboard.css" rel="stylesheet">
		<script>
			function openForm() {
				document.getElementsByTagName("form")[1].style.display = "table";
				document.getElementById("open").disabled = true;
			}
			function closeForm() {
				document.getElementsByTagName("form")[1].style.display = "none";
				document.getElementById("open").disabled = false;
			}

			function signOut() {
				document.getElementsByTagName("form")[0].style.display = "table";
				document.getElementById("signout").disabled = true;
			}

			function cancel() {
				document.getElementsByTagName("form")[0].style.display = "none";
				document.getElementById("signout").disabled = false;
			}
			function addPropertyCard() {
				let dashboard = document.getElementById("dashboard");
				var div = document.createElement("div");
				div.classList.add("card");
				let arr = {
					"address" : document.getElementById("address").value,
					"city" : document.getElementById("city").value,
					"state" : document.getElementById("state").value,
					"zip" : document.getElementById("zip").value,
					"price" : document.getElementById("price").value,
					"bedroom numbers" : document.getElementById("beds").value,
					"bathroom numbers" : document.getElementById("baths").value,
					"age" : document.getElementById("age").value,
					"acquisition date" : document.getElementById("acquisition").value,
					"Extra Information" : document.getElementById("extra").value,
				};
				var result = "";
				for (let key in arr) {
					if (arr.hasOwnProperty(key)) {
						result += `<p>${key}: ${arr[key]}</p>`;
					}
				}
				div.textContent = result;
				dashboard.appendChild(div);
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
		<div>
			<form method="post" action="./dashboard.php">
			<button id="Cancel" onclick="cancel()">Cancel</button><br>
			<input type="submit"name="signOut" value="Sign Out">
			</form>
		</div>
		<button id="signout" onclick="signOut()">SignOut</button>
		<button id="open" onclick="openForm()">+</button>
		<form method="post" action="./dashboard.php" id="sellerForm">
			<div id="form-header">
				<h1>Add Property</h1>
				<button onclick="closeForm()" id="close">X</button>
			</div>
			<p>
				<label for="address">Address<span class="required">*</span>:</label>
				<input type="text" name="address" id="address" required /><br>
			</p>
			<p>
				<label for="city">City<span class="required">*</span>:</label>
				<input type="text" name="city" id="city" required /><br>
			</p>
			<p>
				<label for="state">State<span class="required">*</span>:</label>
				<input type="text" name="state" id="state" required /><br>
			</p>
			<p>
				<label for="zip">Zip<span class="required">*</span>:</label>
				<input type="text" name="zip" id="zip" required /><br>
			</p>
			<p>
				<label for="price">Listing Price<span class="required">*</span>:</label>
				<input type="text" name="price" id="price" required /><br>
			</p>
			<p>
				<label for="beds">Number of Bedrooms<span class="required">*</span>:</label>
				<input type="text" name="beds" id="beds" required /><br>
			</p>
			<p>
				<label for="baths">Number of Bathrooms<span class="required">*</span>:</label>
				<input type="text" name="baths" id="baths" required /><br>
			</p>
			<p>
				<label for="age">Property Age:</label>
				<input type="text" name="age" id="age" /><br>
			</p>
			<p>
				<label for="acquisition">Acquisition Date:</label>
				<input type="date" name="acquisition" id="acquisition"/><br>
			</p>
			<p>
				<label for="extra">Additional Details:</label>
				<textarea name="extra" id="extra"></textarea><br>
				<input type="submit" id="submit" name="submit" onclick="addPropertyCard()" value="Submit" />
		</form>
		<div id="dashboard">
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