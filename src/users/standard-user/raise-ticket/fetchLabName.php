<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

// retrieve lab names from the lab_t table
$sql = "SELECT lab_id, lab_name FROM lab_t";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and display lab names as options
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['lab_id'] . '">' . $row['lab_name'] . '</option>';
    }
} else {
    echo '<option value="">No labs found</option>';
}

$conn->close();
?>
