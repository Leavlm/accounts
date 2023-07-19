<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

$query = $dbCo->prepare("INSERT INTO `transaction` (name, date_transaction, amount, id_category) VALUES (:name, :date_transaction, :amount, :id_category)");
$isOK = $query->execute([
    'name' => htmlspecialchars($_POST['name']),
    'date_transaction' => htmlspecialchars($_POST['date']),
    'amount' => floatval(htmlspecialchars($_POST['amount'])),
    'id_category' => $_POST['category']
]);
header('location: index.php?msg='.($isOK ? 'transSuccess' : 'transFail'));
exit;
