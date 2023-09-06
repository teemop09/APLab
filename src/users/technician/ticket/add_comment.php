<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the comment content from the POST request
    $tic_id = $_POST['ticket_id'];
    $content = $_POST["comment"];
    $redirect_url = "ticket_details.php?ticket_id=$tic_id";
    if (!empty($content)) {

        // Example SQL query (replace with your actual query):
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
        $tech_id = 'TS0001'; // TODO: get technican ID from POST or session
        $stmt->bind_param('ssss', $content, $timestamp, $tic_id, $tech_id);
        $result = $stmt->execute();

        var_dump($stmt);
        var_dump($result);
    }
    header("Location: $redirect_url");

} else {
    // Handle other HTTP methods or direct script access
    http_response_code(405); // Method Not Allowed
}
?>