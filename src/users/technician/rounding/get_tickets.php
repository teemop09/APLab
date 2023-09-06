<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT
                t.tic_status AS 'ticket status',
                e.equ_id AS 'equipment id',
                e.equ_name AS 'equipment name'
            FROM
                ticket_t t
            JOIN equipment_t e ON
                t.equ_id = e.equ_id;
            ";
    $conn->query($sql);
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $info = array(
                "ticket status" => $row["ticket status"],
                "equipment id" => $row["equipment id"],
                "equipment name" => $row["equipment name"]
            );
            $data[] = $info;
        }
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($data);
}


?>