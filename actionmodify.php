<?php
require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

$id = $_GET['id'];
var_dump($id);
// if (!is_numeric($id) || intval($id) <= 0) {
//     exit("ID invalide");
// }

$query = $dbCo->prepare("UPDATE `transaction` SET name = :name, date_transaction = :date, amount = :amount, id_category = :id_category WHERE id_transaction = :id");
$isOK = $query->execute([
    'name' => htmlspecialchars($_REQUEST['name']),
    'amount' => floatval(strip_tags($_REQUEST['amount'])),
    'date' => strip_tags($_REQUEST['date']),
    'id_category' => intval(strip_tags($_REQUEST['category'])),
    'id' => intval(strip_tags($_GET['id']))
]);

header('location: index.php?msg='.($isOK ? 'modifSuccess' : 'modifFail'));
exit;