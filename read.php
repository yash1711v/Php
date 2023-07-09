<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yashdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the table
$table = "yash1"; // Adjust table name

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th><th>Column 5</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["column1"] . "</td>";
        echo "<td>" . $row["column2"] . "</td>";
        echo "<td>" . $row["column3"] . "</td>";
        echo "<td>" . $row["column4"] . "</td>";
        echo "<td>" . $row["column5"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
