<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/components/protected.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the comment content from the POST request
    $tic_id = $_POST['ticket_id'];
    $content = $_POST["comment"];
    $redirect_url = "ticket_details.php?ticket_id=$tic_id";
    if (!empty($content)) {

        $query = "INSERT INTO comment_t(
                    com_id,
                    com_content,
                    com_timestamp,
                    tic_id,
                    tech_id
                )
                VALUES(
                    UUID(),
                    ?,
                    ?,
                    ?,
                    ?
                );";
        $stmt = $conn->prepare($query);
        $timestamp = date("Y-m-d H:i:s"); // Current timestamp
        $tech_id = $_SESSION['userID'];
        $stmt->bind_param('ssss', $content, $timestamp, $tic_id, $tech_id);
        $result = $stmt->execute();
        include $_SERVER["DOCUMENT_ROOT"] . "/src/users/technician/ticket/ticket_to_pending.php";
        var_dump($stmt);
        var_dump($result);
    }
    header("Location: $redirect_url");

} else {
    // Handle other HTTP methods or direct script access
    http_response_code(405); // Method Not Allowed
}
?>