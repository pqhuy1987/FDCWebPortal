<?php

$db_exists = file_exists("daypilot.sqlite");

$db = new PDO('sqlite:daypilot.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// other init
date_default_timezone_set("UTC");
session_start();

if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE project (project_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_name VARCHAR (200));");
    $db->exec("CREATE TABLE event (event_id INTEGER PRIMARY KEY, event_name TEXT, event_start DATETIME, event_end DATETIME, person_id INTEGER (30), project_id INTEGER);");
    $db->exec("CREATE TABLE person (person_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, person_name VARCHAR (200));");

    // projects
    $items = array(
        array('name' => 'Project 1'),
        array('name' => 'Project 2'),
        array('name' => 'Project 3'),
    );
    $insert = "INSERT INTO project (project_name) VALUES (:name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
      $name = $m['name'];
      $stmt->execute();
    }

    // people
    $items = array(
        array('name' => 'Person 1'),
        array('name' => 'Person 2'),
        array('name' => 'Person 3'),
        array('name' => 'Person 4'),
        array('name' => 'Person 5'),
        array('name' => 'Person 6'),
        array('name' => 'Person 7'),
        array('name' => 'Person 8'),
        array('name' => 'Person 9'),
    );
    $insert = "INSERT INTO person (person_name) VALUES (:name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
      $name = $m['name'];
      $stmt->execute();
    }

}

?>
