<?php

namespace User;

include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/User/User.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/app/api/User/policy.php");

function cookCookie($k,$v) {
    setcookie($k, $v, time() + (86400 * 30) );
}
////////////////
// GET
// any
function create() : ?User {
   $req = $_GET;

   $user = new User();
   $user->new($req);

   if (
   isUsefulForCreate($user) &&
   isEmail($user->email)
   ) { $user->create();
       return $user; }

   return NULL;
}
// GET
// email
function findByEmail() : ?array {
    $req = $_GET;
    $user = new User();
    $data = $user->read('email',$req['email']);
    if (empty($data)) {$data = NULL;};
    return $data;
}
// GET
// name
function findByName() : ?array {
    $req = $_GET;
    $user = new User();
    $data = $user->read('name',$req['name']);
    if (empty($data)) {$data = NULL;};
    return $data;
}
// GET / POST
// email
function deleteByEmail() : bool {
    empty($_GET)? $req = $_POST : $req = $_GET;
    $comment = new User();
    $comment->delete("email",$req['email']);
    return true;
}
// POST
// any
function update() : bool {
    $req = $_GET;
   // if (true === true) {
        $user = new User();
        $user->update($req);
   // }
   // return NULL;
    return true;
}
// POST
// name hash
function checkUser() : bool {
    $req =$_POST;
    $user = new User();
    $user = $user->read("name",$req["name"])[0];
    return matchHash($user['hash'],$req['hash']);
}
// POST
// email hash
function login()  {
    $req =$_GET;
    $user = new User();
    $user = $user->read("email",$req["email"])[0];
    if (matchHash($user['hash'],$req['hash']) ) {
        return $user;
    } else {
        return NULL;
    }
}