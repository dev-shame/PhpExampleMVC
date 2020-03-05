<?php

namespace Comment;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/Comment.php");

// GET
// user, content, likes
function create() : bool{
    $req = $_GET;
    if ($req['user'] === NULL) {http_response_code(400); return false;}
    $comment = new Comment();
    $comment->create(
        $req['user'],
        $req['content'],
        $req['likes']
    );
    http_response_code(200);
    return true;
}

// GET
// user
function find(){
    $req = $_GET;
    $comment = new Comment();
    $data = $comment->findByUser($req['user']);
    $json = json_encode($data);
    echo $json;
    http_response_code(200);
}
