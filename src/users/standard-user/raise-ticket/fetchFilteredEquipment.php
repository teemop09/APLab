<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

$labId = $_GET['lab_id'];

$sql = "SELECT equ_id, equ_name FROM equipment_t WHERE lab_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $labId); // Assuming lab_id is a string

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);

    $equipmentNames = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $equipmentNames[] = $row;
    }

    // Return the equipment names as JSON
    echo json_encode($equipmentNames);
} else {
    echo json_encode([]); // Return an empty array if there's an error
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
