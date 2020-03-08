<?php

namespace Comment;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/Comment.php");
// GET
// any
function create() : bool{
    $req = $_GET;
    if ($req['fromUser'] === NULL) {http_response_code(400); return false;}
    $comment = new Comment();
    $comment->create($req);
    http_response_code(200);
    return true;
}
// GET
// user
function findByUser(){
    $req = $_GET;
    $comment = new Comment();
    $data = $comment->read('fromUser',$req['user']);
    $json = json_encode($data);
    echo $json;
    http_response_code(200);
}
// GET / POST
// id
function delete() : bool {
    empty($_GET)? $req = $_POST : $req = $_GET;
    if ($req['id'] === NULL) {http_response_code(400); return false;}
    $comment = new Comment();
    $comment->delete("id",$req['id']);
    http_response_code(200);
    return true;
}
// POST
// any
function update() : bool {
    $req = $_POST;
    if (!$req['id']) {http_response_code(400); return false;}
    $comment = new Comment();
    $comment->update($req);
    http_response_code(200);
    return true;
}
