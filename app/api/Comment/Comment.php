<?php
// global declaration
namespace Comment;
function getDomain () {
    return "domain";
}

class Comment
{
    public $myField;
}

$a = new Comment();
$a->myField = "text";



$data = new \Engine\DatabaseInfo();
$data->table = "table";
$data->file = "./../../.cache/file.sqlite";
/*
$adapter = new \Engine\SQLite3Adapter();
$adapter->openTable($data,$a);
$adapter->push($data,$a);*/

