<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

$ticket_id = "";
$row = null;
$query_output = array();

if (
    $_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_GET["ticket_id"]) &&
    !empty($_GET["ticket_id"])
) {
    var_dump($_GET);
    $ticket_id = $_GET["ticket_id"];

    // Sanitize the input to prevent SQL injection
    $ticket_id = $conn->real_escape_string($ticket_id);
    $sql = "SELECT
                t.tic_id AS 'ticket id',
                t.tic_subject AS 'subject',
                t.tic_description AS 'description',
                t.tic_priority AS 'priority',
                t.tic_status AS 'status',
                t.tic_open_date AS 'raised on',
                t.tic_close_date AS 'completed on',
                e.equ_name AS 'pc name',
                c.com_id AS 'comment id',
                c.com_content AS 'content',
                c.com_timestamp AS 'timestamp',
                c.com_is_solution AS 'is solution',
                CONCAT(tech.tech_first_name, ' ', tech.tech_last_name) AS 'username'
            FROM
                ticket_t AS t
            JOIN equipment_t AS e ON t.equ_id = e.equ_id
            LEFT JOIN comment_t AS c ON t.tic_id = c.tic_id
            LEFT JOIN technician_t AS tech ON c.tech_id = tech.tech_id
            WHERE
                t.tic_id = '$ticket_id'
            ORDER BY
                c.com_timestamp DESC;
            ;";

    $result = $conn->query($sql);

    if ($result === false) {
        // Error handling for the query execution
        echo "Error executing the query: " . $conn->error;
    } elseif ($result->num_rows < 0) {
        echo "No tickets found.";
    }

    $comments = array();

    while ($row = $result->fetch_assoc()) {
        $query_output = $row;
        if ($row["comment id"] == null) {
            continue;
        }
        $comment["comment id"] = $row["comment id"];
        $comment["content"] = $row["content"];
        $comment["timestamp"] = $row["timestamp"];
        $comment["username"] = $row["username"];
        $comment["is solution"] = (bool) $row["is solution"];

        $comments[] = $comment;
        // At this point $comments is an array of arrays
        var_dump($row);
        var_dump($result);
    }
    $query_output['comments'] = $comments;
    var_dump($row);

}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Ticket</title>
    <link rel="stylesheet" href="ticket_details.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="ticket_details.js"></script>
</head>

<body>
    <!-- load Header -->
    <div id="headerContainer"></div>
    <script src="/src/users/technician/headerFooter/TaTssHeader/loadTaTssHeader.js"></script>

    <?php if ($query_output): ?>
        <div id="site-name">TICKET
            <?php echo $query_output["ticket id"]; ?>
        </div>

        <p>PC Location:
            <?php
            $pc_name = $query_output["pc name"];
            $lab = explode("-", $pc_name)[0] . "-" . explode("-", $pc_name)[1];
            $href = "/src/users/technician/rounding/layout.php?lab=" . $lab;
            ?>
            <a href="<?= $href ?>"> <?= $pc_name ?> </a>
        </p>
        <p>Ticket Subject:
            <?php echo $query_output["subject"]; ?>
        </p>
        <p>Ticket Description:
            <?php echo $query_output["description"]; ?>
        </p>
        <p>Issued On:
            <?php echo $query_output["raised on"]; ?>
        </p>
        <?php
        // only show 'completed on' if it is not null
        if ($query_output["completed on"] != null): ?>
            <p>Completed On:
                <?php echo $query_output["completed on"]; ?>
            </p>
        <?php endif; ?>

        <p>Status:
            <?php echo $query_output["status"]; ?>
        </p>
        <p>Troubleshooting Steps:</p>

        <?php if (strtolower($query_output['status']) != 'solved'): ?>
            <button id="start-solving-button">Start solving this ticket</button>
            <form id="new-comment-form" action="add_comment.php" method="post">
                <div class="comment-box">
                    <textarea id="new-comment" name="comment" rows="4" cols="50"
                        placeholder="Add your comment here..."></textarea>
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                    <button id="submit-comment" type="submit">Add</button>
                </div>
            </form>
        <?php endif ?>


        <?php if (count($query_output['comments']) > 0): ?>
            <?php foreach ($query_output['comments'] as $comment): ?>
                <?php $class_to_add = ($comment['is solution'] == true ? "marked-solution" : "") ?>
                <div class="comment <?= $class_to_add ?>" data-comment-id="<?= $comment['comment id'] ?>">
                    <div class="solution-header<?= " " . $class_to_add ?>">
                        <img src="/src/assets/correct.png" width="20" alt="https://www.flaticon.com/free-icons/correct">
                        <span class="solution-text">Solution</span>
                    </div>
                    <div class="comment-inner">
                        <div class="comment-header">
                            <img src="/src/assets/profile.png" width="40" alt="User Avatar">
                            <span class="username">
                                <?= $comment["username"] ?>
                            </span>
                            <div class="timestamp">
                                <?= $comment["timestamp"] ?>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                <?= $comment['content'] ?>
                            </p>
                        </div>
                        <?php if ($class_to_add == ""): ?>
                            <div class="mark-solution">
                                <button class="mark-solution-button">Mark as Solution</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <br>
            <?php endforeach; ?>

        <?php endif; ?>



    <?php endif; ?>
    <!-- load Footer -->
    <div id="footerContainer"></div>
    <script src="/src/users/technician/headerFooter/TaFooter/loadTAfooter.js"></script>

</body>

</html>