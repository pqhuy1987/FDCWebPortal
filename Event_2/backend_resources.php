<?php
require_once '_db.php';

$scheduler_resources = $db->query('SELECT * FROM person ORDER BY person_name');

class Resource {}

$resources = array();

foreach($scheduler_resources as $resource) {
  $r = new Resource();
  $r->id = $resource['person_id'];
  $r->name = $resource['person_name'];
  $resources[] = $r;
}

header('Content-Type: application/json');
echo json_encode($resources);

?>
