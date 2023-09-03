<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/data/conn.php";

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
                t.tic_title AS 'title',
                t.tic_description AS 'description',
                t.tic_priority AS 'priority',
                t.tic_status AS 'status',
                t.tic_open_date AS 'raised on',
                t.tic_close_date AS 'completed on',
                e.equ_name AS 'pc name',
                c.com_content AS 'comment content',
                c.com_timestamp AS 'timestamp',
                CONCAT(
                    tech.tech_first_name,
                    ' ',
                    tech.tech_last_name
                ) AS 'username'
            FROM
                ticket_t AS t
            JOIN equipment_t AS e
            ON
                t.equ_id = e.equ_id
            JOIN comment_t AS c
            ON
                t.tic_id = c.tic_id
            JOIN technician_t AS tech
            ON
                c.tech_id = tech.tech_id
            WHERE
                t.tic_id = '$ticket_id';";

    var_dump($sql);

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
        $comment["content"] = $row["comment content"];
        $comment["timestamp"] = $row["timestamp"];
        $comment["username"] = $row["username"];
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
</head>

<body>
    <h1>View Ticket</h1>
    <form method="get">
        <label for="ticket_id">Enter Ticket Number:</label>
        <input type="text" name="ticket_id" value="<?php echo $ticket_id; ?>">
        <input type="submit" value="Retrieve Ticket">
    </form>

    <?php if ($query_output): ?>
        <h2>Ticket Details</h2>
        <p>Ticket Number:
            <?php echo $query_output["ticket id"]; ?>
        </p>
        <p>PC Name:
            <?php echo $query_output["pc name"]; ?>
        </p>
        <p>Ticket Title:
            <?php echo $query_output["title"]; ?>
        </p>
        <p>Raised On:
            <?php echo $query_output["raised on"]; ?>
        </p>
        <?php
        // only show 'completed on' if it is not null
        if ($query_output["completed on"] != null): ?>
            <p>CompletedOn:
                <?php echo $query_output["completed on"]; ?>
            </p>
        <?php endif; ?>

        <p>Status:
            <?php echo $query_output["status"]; ?>
        </p>
        <p>Troubleshooting Steps:</p>
        <form action="add_comment.php" method="post">
            <div class="add-comment-box">
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Add your comment here..."></textarea>
                <button id="submit-comment" type="submit">Add</button>
            </div>
        </form>

        <?php foreach ($query_output['comments'] as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                    <img src="randomprofilepic.jpg" width="40" alt="User Avatar">
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
            </div>
            <br>
        <?php endforeach; ?>



    <?php endif; ?>
</body>

</html>