<?php

// global declaration
namespace Comment;
<<<<<<< HEAD
use Engine\Model;

function getDomain () {
    return "domain";
=======
include (__DIR__.'/../../../engine/database.php');

 function getDomain () {
    return "comment";
>>>>>>> e6a600c8c715e52dac9b9183ca964a1ca24689c2
}
//TODO: Describe CRUD - methods for this class
class Comment extends Model
{
    public $myField;
}
/*
$a = new Comment();
$a->myField = "text";

$data = new \Engine\DatabaseInfo();
$data->table = "table";
$data->file = "./../../.cache/file.sqlite";*/
/*
$adapter = new \Engine\SQLite3Adapter();
$adapter->openTable($data,$a);
$adapter->push($data,$a);*/

