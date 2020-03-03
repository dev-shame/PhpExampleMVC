<?php

namespace Engine;

use Comment\Comment;
use function Comment\getDomain;

class Route {
     public function __construct($httpMethods,$jobs,$path)
     {
         $this->httpMethods = $httpMethods;
         $this->jobs        = $jobs;
         $this->path        = $path;
     }

     public $httpMethods;
     public $path;
     public $jobs;
 }

 function scanInstances() {
    $dir = __DIR__."/../app/api/";
    $result = scandir($dir);
    $result = array_filter($result,function ($dir){
        return $dir != "." && $dir != "..";
    });
    var_dump($result);
 }

 function serve(){
    scanInstances();
 };

$root = __DIR__."../app/api";
$uri = $_SERVER['REQUEST_URI'];
$result = explode("/",$uri);
$domain = $result[1];

switch ($domain) {
    case getDomain(): require_once($root."/Comment/jobs.php");
}



//header("Location: ./../");