<?php
   
$mng = new MongoDB\Driver\Manager("mongodb+srv://admin:admin@cluster0-xkizr.mongodb.net/test?retryWrites=true&w=majority");
$listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
$res = $mng->executeCommand("admin", $listdatabases);
$query = new MongoDB\Driver\Query([]); 

$rows = $mng->executeQuery("aids.input_videos", $query);

foreach ($rows as $row) {
    echo "$row->Name";
    echo "$row->FPS";
}
?>