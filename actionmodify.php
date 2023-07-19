<?php
require "includes/_database.php";
require "includes/_functions.php";

verifyToken();


$query = $dbCo->prepare("UPDATE `transaction` SET `name` = :name, `amount` = :amount, `date_transaction` = :date WHERE `id_category` = :id");
$isOK = $query->execute([
    'name' => htmlspecialchars($_REQUEST['name']),
    'amount' => floatval(strip_tags($_REQUEST['amount'])),
    'date' => strip_tags($_REQUEST['date'])
]);

header('location: index.php?msg='.($isOK ? 'modifSuccess' : 'modifFail'));
exit;