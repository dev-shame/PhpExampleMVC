<?php

namespace Post;

include_once ($_SERVER['DOCUMENT_ROOT']."/engine/Route.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/jobs.php");
use Engine\Route;

return [
    "/create" => new Route(
        ["GET"],
        "",
        [
            function (){
            $post = create();
            $json = json_encode($post);
            echo $json;
            },
        ],
        ),
    "/find" => new Route(
        ["GET"],
        "",
        [
            function (){
            $posts = findByUser();
                $json = json_encode($posts);
                echo $json;
                http_response_code(200);
        }
        ],
        ),
    "/findAll" => new Route(
        ["GET"],
        "",
        [
            function (){
            $posts= findAll();
            $json = json_encode($posts);
            echo $json;
        }
        ],
        ),
    "/post" => new Route(
        ["GET"],
        "",
        [
            function (){findByPost();}
        ],
        ),
    "/delete" => new Route(
        ["POST","GET"],
        "",
        [
            function (){delete();}
        ],
        ),
    "/update" => new Route(
        ["POST"],
        "",
        [
            function (){update();}
        ],
        ),
];