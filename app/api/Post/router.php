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
            function (){create();},
        ],
        ),
    "/find" => new Route(
        ["GET"],
        "",
        [
            function (){findByUser();}
        ],
        ),
    "/findAll" => new Route(
        ["GET"],
        "",
        [
            function (){findByUser();}
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