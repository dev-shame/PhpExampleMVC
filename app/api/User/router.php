<?php

namespace User;

include_once ($_SERVER['DOCUMENT_ROOT']."/engine/Route.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/app/api/User/jobs.php");

use Engine\Route;

return [
    "/create" => new Route(
        ["GET"],
        "",
        [
            function () : bool {
            $user = create();
            if ($user === NULL) {
                echo 'Error Database';
                http_response_code(400);
                return false;
            }
            cookCookie("name",$user->name);
            cookCookie("email",$user->email);
            cookCookie("hash",$user->hash);
            $json = json_encode($user); echo $json;
            http_response_code(200);
            return true;
            },
        ],
        ),
    "/find" => new Route(
        ["GET"],
        "",
        [
            function () : bool {
            $users =  findByEmail();
            if ($users === NULL) {
                echo 'Not Found';
                http_response_code(400);
                return false;
            }
            $json = json_encode($users); echo $json;
            http_response_code(200);
            return true;
        }
        ],
        ),
    "/delete" => new Route(
        ["POST","GET"],
        "",
        [
            function (){
            deleteByEmail();
            http_response_code(200);
        }
        ],
        ),
    "/update" => new Route(
        ["GET"],
        "",
        [
            function (){
            $result = update();
            if ($result === NULL) {
                echo 'No update';
                http_response_code(400);
                return false;
            } else {
                json_encode($result);
                http_response_code(200);
                return true;
            }
        }
        ],
        ),
    "/login" => new Route(
        ["POST"],
        "",
        [
            function (){
                checkUser();
            }
        ],
        ),
];