<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

$query = $dbCo->prepare("INSERT INTO `transaction` (name, date_transaction, amount, id_category) VALUES (:name, :date, :amount, :id_category)");
$isOK = $query->execute([
    'name' => htmlspecialchars($_REQUEST['name']),
    'date' => htmlspecialchars($_REQUEST['date']),
    'amount' => floatval(htmlspecialchars($_REQUEST['amount'])),
    'id_category' => $_REQUEST['category']
]);
header('location: index.php?msg='.($isOK ? 'transSuccess' : 'transFail'));
exit;

