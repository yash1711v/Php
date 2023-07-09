
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yashdb";

//connection object
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo 'it is Successfull</br>';
}

// Check if a file is uploaded
if (isset($_FILES['file']['name'])) {
    $file = $_FILES['file']['tmp_name'];

    // Read file
    $data = [];
    if (($handle = fopen($file, "r")) !== false) {
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            $data[] = $row;
           // print_r($data);
        }
        fclose($handle);
        // Insert data into the table
        $table = "yash1";
        $columns = implode(",", array("column1", "column2", "column3", "column4", "column5")); 

        $values = [];
        foreach ($data as $row) {
            $escaped_row = array_map(function($value) use ($conn) {
                return "'" . $conn->real_escape_string($value) . "'";
            }, $row);
            $values[] = "(" . implode(",", $escaped_row) . ")";
        }

        $sql = "INSERT INTO $table ($columns) VALUES " . implode(",", $values);

        if ($conn->query($sql) === true) {
            echo "Data imported successfully.";
            include 'read.php';
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// $conn->close();
?>