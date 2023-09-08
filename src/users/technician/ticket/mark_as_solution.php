<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";
$query_success = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Update ticket status
    $updateTicketQuery = "UPDATE
                                `ticket_t` t
                            SET
                                t.`tic_status` = 'Solved',
                                t.`tic_close_date` = NOW()
                            WHERE
                                t.tic_id =(
                                SELECT
                                    c.tic_id
                                FROM
                                    comment_t c
                                WHERE
                                    c.com_id = ?
                            );";
    $updateTicketStmt = $conn->prepare($updateTicketQuery);
    if (!$updateTicketStmt) {
        $query_success = false;
        die("Prepare failed: " . $conn->error);
    }
    $updateTicketStmt->bind_param('s', $_POST['commentId']);
    $result = $updateTicketStmt->execute();
    if ($result === false) {
        $query_success = false;
    }

    $updateTicketStmt->close();

    // Update comment status
    $sql = "UPDATE
                `comment_t` c
            SET
                c.`com_is_solution` = 1
            WHERE
                c.com_id = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['commentId']);
    $result = $stmt->execute();
    if ($result === false) {
        $query_success = false;
    }
    $stmt->close();
    $conn->close();

    echo $query_success;

}
?>