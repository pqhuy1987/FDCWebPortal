<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

class Result {}

$stmt = $db->prepare("UPDATE event SET event_name = :name, project_id = :project, person_id = :resource WHERE event_id = :id");
$stmt->bindParam(':id', $params->id);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':project', $params->project);
$stmt->bindParam(':resource', $params->resource);
$stmt->execute();

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);

?>
