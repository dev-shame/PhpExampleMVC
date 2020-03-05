<?php
namespace Engine;
use Comment\Comment;
use Post\Post;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/Comment.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/jobs.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/Post.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/jobs.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/Log.php");

//get and split url address
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/",$uri);

// class name for app/api
// example:
// from "localhost:8080/user/example/create" return "user"
$domain = $uri[1];

// other route
//example:
// from "localhost:8080/user/example/create" return ["example","create"]
$other = $uri;
array_splice($other, 0, 2);
$other = array_filter($other,function ($e){
    return $e !== "";
}
);

// other transform as string value
// example:
// from ["example","create"] return "/example/create"
// just for fun :)
$otherInString = array_reduce($other,function ($accumulator,$elem){
    return $accumulator."/".$elem;
});
$otherInString = preg_replace('/\?.*/','',$otherInString);

//for debug
Log::console_log($domain);
Log::console_log($other);
Log::console_log($otherInString);

$comment    = new Comment();
$post       = new Post();
switch ($domain) {
    case $comment->getClassName() : $comment->listenRoute($otherInString); break;
    case $post->getClassName() : $post->listenRoute($otherInString); break;
    default: echo 'not found';
}

//$comment = new Comment();
//$comment->listenRoute("/find");




