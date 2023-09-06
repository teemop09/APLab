<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

if (isset($_GET['equ_name'])) {
    $equ_name = $_GET['equ_name'];
    
    $sql = "SELECT equ_id FROM equipment_t WHERE equ_name = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $equ_name);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $equ_id = $row['equ_id'];
            
            // Return the equ_id as JSON
            echo json_encode(['equ_id' => $equ_id]);
        } else {
            // Equipment ID not found
            echo json_encode(['equ_id' => null]);
        }
    } else {
        // Error executing the statement
        echo json_encode(['equ_id' => null]);
    }
    
    mysqli_stmt_close($stmt);
} else {
    // No equ_name provided
    echo json_encode(['equ_id' => null]);
}

mysqli_close($conn);
?>
