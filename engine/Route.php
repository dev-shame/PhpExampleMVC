<?php
namespace Engine;

class Route {

    private $httpMethods;
    private $path; // NOT USED NOW
    private $jobs;

    public function __construct( $httpMethods,string $path,array $jobs)
    {
        $this->httpMethods = $httpMethods;
        $this->path        = $path;
        $this->jobs        = $jobs;
    }

    public function serve() : void {
        $check = false;
        foreach ($this->httpMethods as $httpMethod){
            if (strcasecmp($httpMethod, $_SERVER['REQUEST_METHOD'])===0) {$check = true;}
        }
        if ($check) {
            foreach ($this->jobs as $job) {
                $job->call($this);
            }
        }
    }
}