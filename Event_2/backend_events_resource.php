<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare('SELECT * FROM event LEFT OUTER JOIN project ON event.project_id = project.project_id WHERE NOT ((event_end <= :start) OR (event_start >= :end)) AND person_id = :resource');
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':resource', $params->resource);
$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['event_id'];
  $e->text = $row['event_name'];
  $e->start = $row['event_start'];
  $e->end = $row['event_end'];
  $e->resource = $row['person_id'];
  $e->project = $row['project_name'];
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);

?>
