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
    "/findByName" => new Route(
        ["GET"],
        "",
        [
            function () : bool {
                $users =  findByName()[0];
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
    "/check" => new Route(
        ["POST"],
        "",
        [
            function (){
               if (checkUser()) {
                   http_response_code(200);
                   echo 'ok';
               } else {
                   http_response_code(400);
                   echo 'Err';
               }
            }
        ],
        ),
    "/login" => new Route(
        ["GET"],
        "",
        [
            function() : bool {
               $user = login();
               if ($user === NULL) {
                   echo 'Err';
                   http_response_code(400);
                   return false;
               } else {
                   cookCookie("name",$user['name']);
                   cookCookie("email",$user['email']);
                   cookCookie("hash",$user['hash']);
                   echo json_encode($user);
                   http_response_code(200);
                   return true;
               }
            }
        ],
        ),
];