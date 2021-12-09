<?php
require_once("./connects.php");

$sql = 'SELECT * FROM `brack` ORDER BY `id` DESC LIMIT 3';
$query = $pdo->query($sql);
