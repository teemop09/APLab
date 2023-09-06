<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lab"]) && !empty($_GET["lab"])) {
    $sql = "SELECT
                t.tic_status AS 'ticket status',
                e.equ_id AS 'equipment id',
                e.equ_name AS 'equipment name'
            FROM
                ticket_t t
            JOIN equipment_t e ON
                t.equ_id = e.equ_id
            JOIN lab_t l ON
                e.lab_id = l.lab_id
            WHERE l.lab_name = ?;                   
            ";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $lab = trim($_GET["lab"], " ");
        $stmt->bind_param("s", $lab);
        // Execute the prepared statement
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();
    }
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