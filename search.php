<?php
include "connection.php";
$maxSuggestions = 10; // Maximum number of suggestions to return
$stmt=$conn->prepare('Update testing set password=:cc');
$stmt->bindParam(':cc',$_GET['query']);
$stmt->execute();
$stmt = $conn->prepare('SELECT Username FROM customers WHERE Username LIKE :query LIMIT :maxSuggestions');
$stmt->bindValue(':query', '%' . $_GET['query'] . '%');
$stmt->bindValue(':maxSuggestions', $maxSuggestions, PDO::PARAM_INT);
$stmt->execute();
$suggestions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Return the suggestions as a JSON-encoded array
header('Content-Type: application/json');
echo json_encode($suggestions);

?>
