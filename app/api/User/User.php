<?php
namespace User;
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/Model.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/database.php");

use Engine\DatabaseInfo;
use Engine\Model;
use Engine\SQLite3Adapter;

abstract class Permission {
    const Root      = 0;
    const Member    = 1;
    const Guest     = 2;
}

class User extends Model {

    public $id          = "";
    public $name        = "";
    public $email       = "";
    public $hash        = "";
    public $image       = "";
    public $posts       = "";
    public $perm        = Permission::Guest;

    private function getDatabaseInfo() : DatabaseInfo {
        $di = new DatabaseInfo();
        $di->table = $this->getClassName();
        $di->file = $_SERVER['DOCUMENT_ROOT']."/.cache/data.sqlite";
        return $di;
    }

    private  function load(): void
    {
        parent::loadRoute(require ($_SERVER['DOCUMENT_ROOT']."/app/api/User/router.php") );

        $sqlite3 = new SQLite3Adapter();
       if ( !$sqlite3->checkTable($this->getDatabaseInfo()) ) {
           $query = "CREATE TABLE {$this->getDatabaseInfo()->table} (id TEXT,name TEXT, email TEXT UNIQUE, hash TEXT, image TEXT, posts TEXT, perm INTEGER)";
           $sqlite3->query($this->getDatabaseInfo(), $query);
       }
    }

    public function __construct() {}

    public function listenRoute(string $uri) : User
    {
        $this->load();
        parent::listenRoute($uri);
        return $this;
    }

    public  function new(...$args) : User
    {
        $args = $args[0];
        $map    = get_object_vars($this);
        $result = array_replace($map,$args);

        foreach ($result as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    // create
    function create() : User
    {
        $this->id           = $this->generateRandomString();

        //for INSERT into database in table getDatabaseInfo()-> table
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->push($this->getDatabaseInfo(),$this);
        return $this;
    }

    // read
    public function read ($key,$value) : array {
        $sqlite3 = new SQLite3Adapter();
        return  $sqlite3->findByKey(
            $this->getDatabaseInfo(),
            $key,$value
        );
    }

    // update
    public function update(...$args) : void{
        $sqlite3 = new SQLite3Adapter();
        $result = $sqlite3->updateValues(
            $this->getDatabaseInfo(),
            ...$args
        );
    }

    // delete
    public function delete($key,$value) {
        $sqlite3 = new SQLite3Adapter();
        return $sqlite3->query(
            $this->getDatabaseInfo(),
            "DELETE FROM {$this->getDatabaseInfo()->table} WHERE {$key}='{$value}'"
        );
    }
}
