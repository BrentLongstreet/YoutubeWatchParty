<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Party</title>
    <link rel="stylesheet" href="./css/partyHome.css">
</head>
<body>
    
    <div class="room-form">
        
        <button onclick="makePage()" id = "generate-Button">Generate Link</button>

        <div id = "link-box">
            <p id="link"></p>
            <p id="ports"> Currently, all avaliable ports are full. Try again later.</p>
        </div>

        <button onclick="start()" id = "start" name= "start">Open Link In New Browser</button>
    </div>
    <p>Rooms Self Destruct after an Hour</p>
</body>
</html>
<script src="./js/generatePage.js">  </script> 
<?php
    // Full ports message hidden
    echo '<script type="text/JavaScript">  
    document.getElementById("ports").style.visibility = "hidden";
    </script>' ;
    
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
            // if all ports are full
            if ($row["Port"] ==  "24097" && $row["Active"] == "1") {                
                echo '<script type="text/JavaScript">  
                document.getElementById("generate-Button").style.visibility = "hidden";
                document.getElementById("ports").style.visibility = "visible";
                </script>' ;
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();


    /** define the directory **/
    $dir = "files/";
    /*** cycle through all files in the directory ***/
    foreach (glob($dir."*") as $file) {
    /*** if file is 24 hours (86400 seconds) old then delete it ***/
        if(time() - filectime($file) > 86400){
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
            // Reset port to inactive once file is deleted
            $sql = "UPDATE ports SET Active = '0', Url = NULL WHERE Url = '$file'";
            $result = $conn->query($sql);
            unlink($file);
        }
    }

?>





