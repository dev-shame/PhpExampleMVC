<?php
namespace Comment;
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/Model.php");
include_once    ($_SERVER['DOCUMENT_ROOT']."/engine/database.php");

use Engine\DatabaseInfo;
use Engine\Model;
use Engine\SQLite3Adapter;

//TODO: Describe CRUD - methods for this class
class Comment extends Model {

    public $id          = "";
    public $fromUser    = "";
    public $content     = "";
    public $likes       = 0;

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

    public static function new($fromUser,$content,$likes) : Comment
    {
        $object = new Comment();
        $object->fromUser = $fromUser;
        $object->content = $content;
        $object->likes = $likes;
        return $object;
    }

    public function listenRoute(string $uri) : Comment
    {
        $this->load();
        parent::listenRoute($uri);
        return $this;
    }

    public function create($fromUser,$content,$likes) : Comment
    {
        $this->id = $this->generateRandomString();
        $this->fromUser     = $fromUser;
        $this->content      = $content;
        $this->likes        = $likes;

        //for INSERT into database in table getDatabaseInfo()-> table
        $sqlite3 = new SQLite3Adapter();
        $sqlite3->push($this->getDatabaseInfo(),$this);
        return $this;
    }

    public function findByUser ($user) : array {
        $sqlite3 = new SQLite3Adapter();
        $query = "SELECT * FROM comment WHERE fromUser = '{$user}'";
        $result = $sqlite3->query(
            $this->getDatabaseInfo(),
            $query
            );
        $data = [];
        while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
            array_push($data,$res);
        }
        return $data;
    }

}
