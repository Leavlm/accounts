<?php
require "includes/_database.php";
require "includes/_functions.php";

// verifyToken();

$query = $dbCo->prepare("UPDATE transaction SET title = :title WHERE id_task = :id");
$isOK = $query->execute([
    'title' => strip_tags($_REQUEST['title']),
    'id' => intval(strip_tags($_REQUEST['id']))
]);

header('location: index.php?msg='.($isOK ? 'addtask' : 'failtask'));
exit;