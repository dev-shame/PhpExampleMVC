<?php
namespace Engine;

class Log
{
    public static function  console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
    }
}