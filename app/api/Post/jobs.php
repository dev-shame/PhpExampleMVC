<?php

namespace Post;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/Post.php");
// GET
// any
function create() : bool {
    $req = $_GET;
    if ($req['fromUser'] === NULL) {http_response_code(400); return false;}
    $comment = new Post();
    $comment->create($req);
    http_response_code(200);
    return true;
}
// GET
// user
function findByUser(){
    $req = $_GET;
    $comment = new Post();
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
    $comment = new Post();
    $comment->delete("id",$req['id']);
    http_response_code(200);
    return true;
}
// POST
// any
function update() : bool {
    $req = $_POST;
    if (!$req['id']) {http_response_code(400); return false;}
    $comment = new Post();
    $comment->update($req);
    http_response_code(200);
    return true;
}
