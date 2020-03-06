<?php

namespace User;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/User/User.php");
// GET
// post, user, content, likes
function create() : bool{
    $req = $_GET;
    if ($req['user'] === NULL) {http_response_code(400); return false;}
    $comment = new User();
    $comment->create(
        $req['post'],
        $req['user'],
        $req['content'],
        $req['likes']
    );
    http_response_code(200);
    return true;
}
// GET
// user
function findByUser(){
    $req = $_GET;
    $comment = new User();
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
    $comment = new User();
    $comment->delete("id",$req['id']);
    http_response_code(200);
    return true;
}
// POST
// any
function update() : bool {
    $req = $_POST;
    $comment = new User();
    $comment->update($req);
    http_response_code(200);
    return true;
}
