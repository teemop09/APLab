<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket History</title>
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="./ticket_history.css">
</head>

<body>
    <!-- load Header -->
    <div id="headerContainer"></div>
    <script src="loadHeader.js"></script>

    <p class="st-top">TICKET HISTORY</p>

    <div class = "content" >
        <?php
        if (isset($_SESSION['userID'])) {


            $user_id = $_SESSION['userID'];
            $sql = "SELECT
                        t.tic_id AS 'ticket id',
                        e.equ_name AS 'pc location',
                        t.tic_subject AS 'subject',
                        t.tic_open_date AS 'issued on',
                        t.tic_status AS 'status',
                        CONCAT(
                            tech.tech_first_name,
                            ' ',
                            tech.tech_last_name
                        ) AS 'pic'
                    FROM
                        ticket_t AS t
                    LEFT JOIN comment_t AS c
                    ON
                        t.tic_id = c.tic_id
                    LEFT JOIN technician_t AS tech
                    ON
                        c.tech_id = tech.tech_id
                    JOIN equipment_t AS e
                    ON
                        e.equ_id = t.equ_id
                    WHERE
                        (
                            c.com_timestamp =(
                            SELECT
                                MAX(com_timestamp)
                            FROM
                                comment_t
                            WHERE
                                tic_id = t.tic_id
                        )
                        ) OR(c.com_timestamp IS NULL) AND(t.user_id = ?)
                    ORDER BY
                        t.tic_open_date
                    DESC
                        ;";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_id);

            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                echo "<table class='table table-hover table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>No.</th>"; // Row count column
                echo "<th>Ticket ID</th>";
                echo "<th>PC Location</th>";
                echo "<th>Subject</th>";
                echo "<th>Issued On</th>";
                echo "<th>Status</th>";
                echo "<th></th>"; // Icon column
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $rowCount = 1; // Initialize row count
        
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowCount++ . "</td>"; // Output row count
                    echo "<td>" . $row['ticket id'] . "</td>";
                    echo "<td>" . $row['pc location'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    echo "<td>" . $row['issued on'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    // Details column with a link to the ticket details page
                    echo "<td><a class='details-link' href='ticket_details.php?ticket_id=" . $row['ticket id'] . "'>></a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='lead'><em>No records were found.</em></p>";
            }

            $stmt->close();
        }
        $conn->close();
        ?>
    </div>
    
    <!-- load Footer -->
    <div id="footerContainer"></div>
    <script src="loadFooter.js"></script>

</body>

</html>