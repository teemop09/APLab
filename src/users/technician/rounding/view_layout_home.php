<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');

$sql = "SELECT
        l.lab_name AS 'lab name'
        FROM
        lab_t l;        
        ";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
}
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lab Layout</title>
    <link rel="stylesheet" href="./view_layout_home.css">
</head>

<body>
    <!-- list all labs -->
    <div id="site-name">VIEW LAB LAYOUT</div>

    <!-- <div id="lab-list">
        <?php foreach ($data as $lab): ?>
            <div class="lab">
                <a href="layout.php?lab=<?= $lab["lab name"] ?>">
                    <?= $lab["lab name"] ?>
                </a>
            </div>
        <?php endforeach; ?> -->
    <div id="lab-list">
        <?php $labCount = count($data); ?>
        <?php for ($i = 0; $i < $labCount; $i += 2): ?>
            <div class="row">
                <div class="lab">
                    <a href="layout.php?lab=<?= $data[$i]["lab name"] ?>">
                        <?= $data[$i]["lab name"] ?>
                    </a>
                </div>
                <?php if ($i + 1 < $labCount): ?>
                    <div class="lab">
                        <a href="layout.php?lab=<?= $data[$i + 1]["lab name"] ?>">
                            <?= $data[$i + 1]["lab name"] ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

</body>

</html>