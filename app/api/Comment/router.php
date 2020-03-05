<?php

namespace Comment;

include_once ($_SERVER['DOCUMENT_ROOT']."/engine/Route.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/jobs.php");
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
            function (){find();}
        ],
        ),
];