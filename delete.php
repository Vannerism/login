<?php

include 'conn.php';

$id = $_GET['id'];

$query = "DELETE FROM student WHERE id = ?";
$stmt  = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header('Location: index.php');
