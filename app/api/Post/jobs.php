<?php

namespace Post;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/Post.php");
// GET
// any
function create() : ?Post {
    $req = $_GET;
    if ($req['fromUser'] === NULL) {http_response_code(400); return NULL;}
    $post = new Post();
    $post->new($req);
    $post->create();
    return $post;
}
// GET
// user
function findByUser(){
    $req = $_GET;
    $comment = new Post();
    $data = $comment->read('fromUser',$req['fromUser']);
    return $data;
}
// GET
function findAll(){
    $comment = new Post();
    $data = $comment->readAll();
    return $data;
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
