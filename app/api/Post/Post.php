<?php
namespace Post;
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/Model.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/database.php");

use Engine\DatabaseInfo;
use Engine\Model;
use Engine\SQLite3Adapter;

//TODO: Describe CRUD - methods for this class
class Post extends Model {

    public $id          = "";
    public $header      = "";
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
        parent::loadRoute(require ($_SERVER['DOCUMENT_ROOT']."/app/api/Post/router.php") );

        $sqlite3 = new SQLite3Adapter();
        $sqlite3->openTable($this->getDatabaseInfo(),$this);
    }

    public function __construct() {}

    public function listenRoute(string $uri) : Post
    {
        $this->load();
        parent::listenRoute($uri);
        return $this;
    }

    public static function new($header,$fromUser,$content,$likes) : Post
    {
        $object             = new Post();
        $object->header    = $header;
        $object->fromUser   = $fromUser;
        $object->content    = $content;
        $object->likes      = $likes;
        return $object;
    }

    function create($header,$fromUser,$content,$likes) : Post
    {
        $this->id = $this->generateRandomString();
        $this->header      = $header;
        $this->fromUser     = $fromUser;
        $this->content      = $content;
        $this->likes        = $likes;

        //for INSERT into database in table getDatabaseInfo()-> table
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->push($this->getDatabaseInfo(),$this);
        return $this;
    }

    public function read ($key,$value) : array {
        $sqlite3 = new SQLite3Adapter();
        return  $sqlite3->findByKey(
            $this->getDatabaseInfo(),
            $key,$value
        );
    }

    public function update(...$args){
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->updateValues(
            $this->getDatabaseInfo(),
            ...$args
        );
    }

    public function delete($key,$value) {
        $sqlite3 = new SQLite3Adapter();
        return $sqlite3->query(
            $this->getDatabaseInfo(),
            "DELETE FROM {$this->getDatabaseInfo()->table} WHERE {$key}='{$value}'"
        );
    }
}
