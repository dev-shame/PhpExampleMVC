<?php
namespace Comment;
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/Model.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/database.php");

use Engine\DatabaseInfo;
use Engine\Model;
use Engine\SQLite3Adapter;

class Comment extends Model {

    public $id          = "";
    public $refPost     = "";
    public $fromUser    = "";
    public $content     = "";
    public $likes       =  0;

    private function getDatabaseInfo() : DatabaseInfo {
        $di = new DatabaseInfo();
        $di->table = $this->getClassName();
        $di->file = $_SERVER['DOCUMENT_ROOT']."/.cache/data.sqlite";
        return $di;
    }

    private  function load(): void
    {
        parent::loadRoute(require ($_SERVER['DOCUMENT_ROOT']."/app/api/Comment/router.php") );

        $sqlite3 = new SQLite3Adapter();
        $sqlite3->openTable($this->getDatabaseInfo(),$this);
    }

    public function __construct() {}

    public function listenRoute(string $uri) : Comment
    {
        $this->load();
        parent::listenRoute($uri);
        return $this;
    }

    public  function new(...$args) : Comment
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
    function create() : Comment
    {
       // $this->new($args);
        $this->id           = $this->generateRandomString();

        //for INSERT into database in table getDatabaseInfo()-> table
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->push($this->getDatabaseInfo(),$this);
        return $this;
    }

    //read
    public function read ($key,$value) : array {
        $sqlite3 = new SQLite3Adapter();
        return  $sqlite3->findByKey(
            $this->getDatabaseInfo(),
            $key,$value
        );
    }

    public function readAll() : array {
        $sqlite3 = new SQLite3Adapter();
        return $sqlite3->findAll($this->getDatabaseInfo());
    }

    // update
    public function update(...$args){
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->updateValues(
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
