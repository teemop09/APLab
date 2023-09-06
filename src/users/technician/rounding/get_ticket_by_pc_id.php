<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');

if (
    $_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_GET["id"]) &&
    !empty($_GET["id"])
) {
    $pc_id = $_GET["id"];
    $lab_name = $_GET["lab"];
    $pc_name = $lab_name . "-" . $pc_id;
    $pc_name = trim($pc_name);

    $sql = "SELECT
                t.tic_id,
                t.tic_subject,
                t.tic_status
            FROM
                ticket_t t
            JOIN
                equipment_t e ON t.equ_id = e.equ_id
            WHERE
                e.equ_status = 'deployed'
                AND e.equ_name = ?
            ";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("s", $pc_name);
        // Execute the prepared statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
    }
    $data = array();
    $data["past"] = array();
    $data["open"] = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category = "open";
            if ($row["tic_status"] == "solved") {
                $category = "past";
            }
            $info = array(
                "id" => $row["tic_id"],
                "subject" => $row["tic_subject"]
            );
            $data[$category][] = $info;
        }
    }

    $stmt->close();
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>