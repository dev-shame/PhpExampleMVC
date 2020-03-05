<?php
namespace Engine;
// It's class needful for any instance, which interact with business-logic in app
use ReflectionClass;

class Model {
    private  $routes = [];
    // RELEASE
    // create Model instance which
    public function onCreate(){
        //implement create instance instructions which later save to database
    }
    // read Model instance
    public function onRead(){
        //implement read instructions
    }
    // mutation Model-basis instance
    public function onUpdate(){
    // implement update instance instructions which later save to database
    }
    // delete Model instance
    public function onDelete(){
    // implement delete Model-basis instance from database
    }
    // get class name as lower case string
    public function getClassName() : string {
        try {
            $reflect = new ReflectionClass($this);
            return strtolower ($reflect->getShortName());
        } catch (\ReflectionException $e) {
            echo ($e);
        }
        return "";
    }
    // include router.php for load Routes instance then may use listenRoute()
    public function loadRoute( ...$routes) : void {
        $this->routes = $routes;
    }
    // listen all routes from router.php
    public function listenRoute(string $uri) {
        $routes = $this->routes[0];
        foreach ($routes as $key => $route) {
            if ($uri === $key) {
                $route->serve();
            }
        }
    }
    // generate random text
    public function generateRandomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // TEST
    // test instance
    public function test(){}
}