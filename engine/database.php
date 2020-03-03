<?php
 namespace Engine;
 use SQLite3;
 class DatabaseInfo {
     private    $scheme = NULL;
     private    $lockScheme = false; // block scheme for mutation
     public     $file;
     public     $table;
     public     $host;
     public     $port;

     public function get_scheme()  {return $this->scheme;}
     public function set_scheme($scheme) : void {
         if (!$this->lockScheme) {
             $this->scheme = $scheme; $this->lockScheme = true;
         }
     }
 }
 class TestData {
     public $name;
     public $secondName;
     public $age;
 }
 interface DatabaseInterface {
     function openTable(DatabaseInfo $di, $instance) : bool;
     function push(DatabaseInfo $di,$instance): void;
     function query(DatabaseInfo $di, string $query) : void;
 }
 class SQLite3Adapter implements DatabaseInterface {
     // RELEASE
     // parse array to sql string
     protected function parseValues (array $data) : string {
         $result = array_map(function ($value) {
             return $value." ,";
         },$data);

         $len = count($result);
         $result[$len - 1] = trim($result[$len - 1],",");

         $result = array_reduce($result,function ($accumulator,$value) {
             $accumulator = $accumulator.$value." ";
             return $accumulator;});
         return $result;
     }
     protected function parseValuesForValues (array $data) : string {
         $result = array_map(function ($value) {
             return "'".$value."'"." ,";
         },$data);

         $len = count($result);
         $result[$len - 1] = trim($result[$len - 1],",");

         $result = array_reduce($result,function ($accumulator,$value) {
             $accumulator = $accumulator.$value." ";
             return $accumulator;});
         return $result;
     }
     // typify variable
     protected function typify ($field): string {
         switch (gettype($field)) {
             case "string" :    return "TEXT";
             case "integer" :   return "INTEGER";
             case "double" :    return "REAL";
             case "resource":   return "BLOB";
             default :          return "NULL";
         }
     }
     // get instance fields [columns,rows]
     protected function getInstanceScheme ($instance) {
         $data = (array) $instance;

         $columnNames = array_keys($data);
         $columnValues = array_values($data);

         return [$columnNames,$columnValues];
     }
     //deserialize object to SQL-like fields and return "filed_name filed_type" and cache it
     protected function setScheme (DatabaseInfo $di,$instance) : array {
         $scheme = $di->get_scheme();
         if (gettype($scheme)==="NULL") {

         $data = (array) $instance;

         $columnNames = array_keys($data);
         $columnValues = array_values($data);

         $columnTypes = array_map(function ($key) {
             return $this->typify($key);
         },$columnValues);

         $result = array_map(function ($one,$two) {
             return "{$one} {$two}";
         },$columnNames,$columnTypes);
         $di->set_scheme($result);
         return $result;
         } else{ return $scheme;}
     }
     //transform scheme to SQL CREATE query for all fields in table
     protected function schemeToSQLCreate (DatabaseInfo $di) : string {
        $scheme = $di->get_scheme();
        if( gettype($scheme) === "NULL") {return "NULL"; };
        $result = $this->parseValues($scheme);
        return $result;
     }
     //transform instance's scheme to SQL INSERT query
     protected function schemeToSQLInsert ($instance) : array {
         $scheme = $this->getInstanceScheme($instance);
         $result[0] = $this->parseValues($scheme[0]);
         $result[1] = $this->parseValuesForValues($scheme[1]);
         return $result;
     }
     // check table
     protected function checkTable(DatabaseInfo $di) : bool {
         $db = new SQLite3($di->file);
         $query = "SELECT name FROM sqlite_master WHERE type='table' AND name='{$di->table}'";
         $result = $db->querySingle($query);
         $result = gettype($result) === "string";
         return $result;
     }
     // create table
     protected function createTable(DatabaseInfo $di,$instance) : void {
         $db = new SQLite3($di->file);
         $this->setScheme($di,$instance);
         $sqlFields = $this->schemeToSQLCreate($di);
         $query = "CREATE TABLE $di->table ({$sqlFields})";
         $result = $db->querySingle($query);
     }
     // open table return boolean if table already exists
     public function openTable (DatabaseInfo $di, $instance) : bool {
        $result = $this->checkTable($di);
        if (!$result)
            $this->createTable($di,$instance);
        return $result;
     }
     //push data to table
     public function push(DatabaseInfo $di, $instance): void
     {
       $db = new SQLite3($di->file);
       $result = $this->schemeToSQLInsert($instance);
       $query = "INSERT INTO {$di->table} ({$result[0]}) VALUES ({$result[1]})";
       $db->query($query);
     }
     //simple query
     function query(DatabaseInfo $di, string $query): void
     {
         $db = new SQLite3($di->file);
         $db->query($query);
     }
     // TEST
     // test instance of this class
     public function test_openTable() : void {
         $databaseInfo = new DatabaseInfo();
         $databaseInfo->table = "test_table";
         $databaseInfo->file = "./data.sqlite";

         $testData =  new TestData();
         $testData->name = "Test Name";
         $testData->secondName = "Second Name Test";
         $testData->age = 25;

         $result =  $this->openTable($databaseInfo,$testData);

         echo '<br/>';
         var_dump($databaseInfo);
         echo '<br/>';
         var_dump($testData);
         echo '<br/>';
         var_dump($result);
     }
     public function test_push() : void {
         $databaseInfo = new DatabaseInfo();
         $databaseInfo->table = "test_table";
         $databaseInfo->file = "./data.sqlite";

         $testData =  new TestData();
         $testData->name = "Test Name";
         $testData->secondName = "Second Name Test";
         $testData->age = 25;

         $this->push($databaseInfo,$testData);
     }
     public function test() : void {
         $this->test_openTable();
         $this->test_push();
     }
 }

 /*$d = new SQLite3Adapter();
 $d->test();*/

