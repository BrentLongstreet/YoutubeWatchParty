<?php
// Start the session
session_start();
?>
<?php

$content = file_get_contents('partyPlaceHolder.php');
$portsFull = file_get_contents('no-ports.php');
//make a random file name
$file = "files/" . uniqid() . ".php";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "watchparty";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ports";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // current row is not active
        if ($row["Active"] ==  "0") {
            $_SESSION["port"] = $row["Port"];
            file_put_contents($file, $content);
            echo $file;
            // store the port in txt
            file_put_contents('ports.txt', $_SESSION["port"]);
            $port = $_SESSION["port"];
            $updatesql = "UPDATE ports SET Active='1', Url = '$file' WHERE Port='$port'";
            $newresult = $conn->query($updatesql);
            break;
        }
        // ports full
        if ($row["Port"] ==  "24097" && $row["Active"] == "1") {
            file_put_contents($file, $portsFull);
            echo $file;
    }
}} else {
    echo "0 results";
}
$conn->close();
?>

