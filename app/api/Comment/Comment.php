<?php
// global declaration
namespace Comment;
use Engine\Model;

function getDomain () {
    return "domain";
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

