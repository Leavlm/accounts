<?php
require "includes/_database.php";
require "includes/_functions.php";

// verifyToken();

$id = $_GET['id'];
if (!is_numeric($id) || intval($id) <= 0) {
    exit("ID invalide");
}

$query = $dbCo->prepare("DELETE FROM `transaction` WHERE id_transaction = :id");
$isOK = $query->execute([
    'id' => intval(strip_tags($_GET['id']))
]);

header('location: index.php?msg='.($isOK ? 'deleteSuccess' : 'deleteFail'));
exit;






