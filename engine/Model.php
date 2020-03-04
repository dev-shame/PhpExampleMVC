<?php
namespace Engine;

// It's class needful for any instance, which interact with business-logic in app
abstract class Model {
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
    // get class name
    public function getClassName() : string{
       return get_class($this);
    }
    // TEST
    // test instance
    public function test(){}
}