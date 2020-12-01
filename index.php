<?php
require_once('Classes/dbfunctions.php');
require_once('Classes/flights.php');

$db = new DataFunctions();

$results = $db->GetAll("golf_users");

$golfers = array();

foreach($results as $result){
	$golfer = array($result['handicap'], $result['name'], $result['gender']);
	array_push($golfers, $golfer);
}

$results = $db->GetAll("golf_users");

$flights = new Flights();

$current_flights = $flights->getFlights($golfers);
?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>
</head>
<body>
<h2>Golfers</h2>
<table>
	<tr>
		<th>Naam</th>
		<th>Geslacht</th> 
		<th>Handicap</th>
	</tr>
	<?php
		foreach($results as $result){
			echo "<tr><td>" . $result['name'] . "</td>";
			echo "<td>" . $result['gender'] . "</td>";
			echo "<td>" . $result['handicap'] . "</td></tr>";
		}
	?>
</table>

<?php
// define variables and set to empty values
$error = false;
$nameErr = $handicapErr = $genderErr = "";
$name = $handicap = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
	$error = true;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
	  $error = true;
    }
  }
  
  if (empty($_POST["handicap"])) {
    $handicapErr = "Handicap is required";
	$error = true;
  }else{
	$handicap = test_input($_POST["handicap"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
	$error = true;
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if(!$error){
		$db->Insert("golf_users", array($name, $gender, $handicap));
		header("refresh: 3;");
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Golfer toevoegen</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		<table>
			<tr>
				<td> Naam: </td> 
				<td>
					<input type="text" name="name" value="<?php echo $name;?>">
					 <span class="error">* <?php echo $nameErr;?></span>
				</td>
			</tr>
			<tr>
				<td> Handicap: </td>
				<td>
					<input type="text" name="handicap" value="<?php echo $handicap;?>">
					<span class="error">* <?php echo $handicapErr;?></span>
				</td>
			</tr>
			<tr>
				<td>Geslacht</td>
				<td>
					<input type="radio" name="gender" <?php if (isset($gender) && $gender=="m") echo "checked";?> value="m">Man
					<input type="radio" name="gender" <?php if (isset($gender) && $gender=="f") echo "checked";?> value="f">Vrouw
					<span class="error">* <?php echo $genderErr;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" value="Submit">  
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
<h2>Flights</h2>
<table>
	<?php
	$counter = 1;
	foreach($current_flights as $flight){
		echo "<tr><th colspan='2'>Flight " . $counter . "</th></tr>";
		foreach($flight as $golfer){
			echo "<tr><td>" . $golfer[1] . " - Handicap: " . $golfer[0] . "</td></tr>";
		}
		$counter++;
	}
	?>
</table>

