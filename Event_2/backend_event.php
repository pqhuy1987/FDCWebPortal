<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare('SELECT * FROM event WHERE event_id = :id');
$stmt->bindParam(':id', $params->id);
$stmt->execute();
$result = $stmt->fetchAll();

class Event {}

$row = $result[0];
$e = new Event();
$e->id = $row['event_id'];
$e->text = $row['event_name'];
$e->start = $row['event_start'];
$e->end = $row['event_end'];
$e->resource = $row['person_id'];
$e->project = $row['project_id'];

header('Content-Type: application/json');
echo json_encode($e);

?>
