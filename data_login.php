<?php
// Database connection parameters
$servername = "localhost";
$username = "id21704108_data";
$password = "Kamisama&07";
$dbname = "id21704108_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from your database table
$sql = "SELECT * FROM connect";
$result = $conn->query($sql);

// Function to clean and format data for Excel
function cleanData($str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    return $str;
}

// Set headers for Excel file download
header("Content-Disposition: attachment; filename=\"Login_info.xls\"");
header("Content-Type: application/vnd.ms-excel");

// Start creating Excel file
$flag = false;
while ($row = $result->fetch_assoc()) {
    if (!$flag) {
        // Display column names as first row in Excel
        echo implode("\t", array_keys($row)) . "\n";
        $flag = true;
    }
    // Iterate through each row and add data to the Excel file
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
}
exit;
?>