<?php

require_once 'init2.php';

$db = new DBORM('mysql:host=localhost;dbname=usjr','root','root');


// $result = $db->table('students')->insert([2015,'Gudio','Camocamo','Jeoffrey',1002,5,4]);  // sample insertion
// echo $db->showQuery();

//  $result = $db->select()->from('students')->getAll(); // Get all rows from a table
//  echo $db->showQuery();

// $result = $db->select()->from('students')->where('studcollege','SCS')->getAll(); // Get all rows from a table matching a criteria
// echo $db->showQuery();

// $result = $db->select()->from('students')->where('studfname','Roderick')->get(); // Get a single row fron a table that matches the criteria
// echo $db->showQuery();

$result = $db->table('students')->where('studfirstname','Godio')->update(['studfirstname'=>'Gudio']); // sample update
echo $db->showQuery();

// $result = $db->table('students')->where('studid', 2015)->delete(); // sample delete
// echo $db->showQuery();