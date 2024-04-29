<?php
session_start();
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
	$sql = "INSERT INTO PROPERTYDATA (address, city, state, zip, price, beds, baths, age, acquiredDate, extra) 
	VALUES (\"$street\", \"$city\", \"$state\", \"$zip\", \"$price\", $beds, $baths, $age, \"$acquisition\", \"$extra\")";
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
		<link rel="stylesheet" type="text/css" href="sellerDashboard.css" />
		<script src="scripts.js"></script>
	</head>

	<body>
		<button id="add" onclick="addProperty()">+</button>
		<form method="post" action="./sellerDashboard.php">
			<div id="container1">
				<h1>Add Property</h1>
				<button onclick="closeForm()" id="close">Close</button>
			</div>
				<label for="address">Address<span class="required">*</span>:</label>
				<input type="text" name="address" required /><br>

				<label for="city">City<span class="required">*</span>:</label>
				<input type="text" name="city" required /><br>
			
				<label for="state">State<span class="required">*</span>:</label>
				<input type="text" name="state" required /><br>
			
				<label for="zip">Zip<span class="required">*</span>:</label>
				<input type="text" name="zip" required /><br>
			
				<label for="price">Listing Price<span class="required">*</span>:</label>
				<input type="text" name="price" required /><br>
			
				<label for="beds">Number of Bedrooms<span class="required">*</span>:</label>
				<input type="text" name="beds" required /><br>
			
				<label for="baths">Number of Bathrooms<span class="required">*</span>:</label>
				<input type="text" name="baths" required /><br>
			
				<label for="age">Property Age:</label>
				<input type="text" name="age" /><br>
			
				<label for="acquisition">Acquisition Date:</label>
				<input type="date" name="acquisition" /><br>
			
				<label for="extra">Additional Details:</label>
				<textarea name="extra"></textarea><br>
			<input type="submit" name="submit" value="Submit" />
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