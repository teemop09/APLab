<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

// Generate custom ticket ID
function generateCustomID($conn)
{
    mysqli_begin_transaction($conn);

    try {
        // Retrieve last custom ID
        $query = "SELECT MAX(tic_id) AS lastID FROM ticket_t";
        $result = mysqli_query($conn, $query);

        if ($result === false) {
            throw new Exception('Error executing query: ' . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);

        if ($row === false) {
            throw new Exception('Error fetching last ID: ' . mysqli_error($conn));
        }

        $lastID = $row['lastID'];

        // Extract the numeric part of the last ID
        $numericPart = (int) substr($lastID, 1);
        $numericPart++;

        // Format the numeric part with leading zeros
        $formattedNumericPart = str_pad($numericPart, 4, '0', STR_PAD_LEFT);

        // Combine the prefix and numeric part to create the custom ID
        $customID = 'T' . $formattedNumericPart;

        mysqli_commit($conn);

        return $customID;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        throw $e;
    }
}

try {
    // Generate the custom ticket ID (get the function from top)
    $customID = generateCustomID($conn);

    $get_equ_id = "SELECT
                        e.equ_id AS 'equipment id'
                    FROM
                        equipment_t e
                    WHERE
                        e.equ_name = ?
                ";
    $stmt = $conn->prepare($get_equ_id);
    var_dump($_POST['computer_id']);
    $stmt->bind_param("s", $_POST['computer_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    var_dump($result);
    $row = $result->fetch_assoc();
    var_dump($row);
    $equ_id = $row['equipment id'];



    $sql = "INSERT INTO ticket_t(
            tic_id,
            tic_alt_email,
            tic_subject,
            tic_description,
            tic_open_date,
            lab_id,
            equ_id,
            user_id
        )
        VALUES(?,?,?,?,NOW(),?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        throw new Exception('Error preparing SQL statement: ' . mysqli_error($conn));
    }

    $stmt->bind_param("sssssss", $customID, $_POST['alt_email_address'], $_POST['subject'], $_POST['problem_description'], $_POST['techlab_id'], $equ_id, $_POST['user_id']);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Ticket Submitted!"); window.location.href= "submitTicket.php";</script>';
    } else {
        die('Error: ' . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} finally {
    mysqli_close($conn);
}
?>