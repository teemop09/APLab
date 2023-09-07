<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";

$sql = "UPDATE
        ticket_t
        SET
        tic_status = 'Pending (Taken)'
        WHERE
        tic_id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $tic_id);
$result = $stmt->execute();

?>