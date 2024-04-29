<?php

function connect(){
	$servername = "localhost";
	$username = "atebeje1";
	$password = "atebeje1";
	$dbname = "atebeje1";
	return new mysqli($servername, $username, $password, $dbname);
}

$address = $_POST['address'] . ", " . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'];

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = connect();
if($conn->connect_error) {
	die("connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS PROPERTYDATA (
	address VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
	state CHAR(2) NOT NULL,
	zip CHAR(5) NOT NULL,
	price VARCHAR(50) NOT NULL,
	beds INT NOT NULL,
	baths INT NOT NULL,
	age INT,
	acquiredDate YEAR,
	extra VARCHAR(255)
	)";
if(!$conn->query($sql) === TRUE) {
	echo "Error creating table: " . $conn->error;
}
$conn->close();
function addProperty(){
	$conn = connect();
	$street = $_POST["address"];
	$city = $_POST['city'];
	$sql = "INSERT INTO PROPERTYDATA (address, city, state, zip, price, beds, baths, age, acquiredDate, extra) 
	VALUES ($street, $city, $_POST[state], $_POST[zip], $_POST[price], $_POST[beds], $_POST[baths], $_POST[age], $_POST[acquiredDate])";
	if($conn->query($sql) === TRUE){
		echo "working";
	} else {
		echo "Error inserting into table: " . $conn->error;
	}
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="sellerDashboard.css" />
		<script src="scripts.js"></script>
	</head>

	<body>
		<button id="add" onclick="addProperty()">+</button>
		<form method="post">
			<div id="container1">
				<h1>Add Property</h1>
				<button onclick="closeForm()" id="close">Close</button>
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
				<input type="text" name="acquisition" /><br>
			</p>
			<p>
				<label for="extra">Additional Details:</label>
				<textarea name="extra"></textarea><br>
			</p>
			<input type="submit" value="Submit" />
		</form>
		<div id="dashboard">
			<!---->
		</div>

		<div class="card">
			<div id="container2">
				<h2><?= $address ?></h2>
				<button onclick="deleteProperty()"><img class="delete" src="delete.png" alt="delete property"/></button>
			</div>
			<label for="age">Property Age:</label><br>
			<p name="age"><?= $_POST["age"] ?></p>
			<label for="acquisition">Acquisition Date:</label>
			<p name="date"><?= $_POST['acquisition'] ?></p>
		</div>
	</body>

</html>