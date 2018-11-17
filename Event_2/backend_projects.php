<?php
require_once '_db.php';

$scheduler_projects = $db->query('SELECT * FROM project ORDER BY project_name');

class Item {}

$items = array();

foreach($scheduler_projects as $project) {
  $r = new Item();
  $r->id = $project['project_id'];
  $r->name = $project['project_name'];
  $items[] = $r;
}

header('Content-Type: application/json');
echo json_encode($items);

?>
