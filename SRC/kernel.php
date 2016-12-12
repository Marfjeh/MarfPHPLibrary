<?php

//Load libs
require_once("./lib/mff.class.php");
require_once("./lib/database.class.php");
require_once("./lib/error.class.php");
require_once("./lib/route.class.php");
//end libs


//database settings

//end database settings

class kernel {
    public function openDb() {
        $db = new Database();
    }
    public function run() {
        $this->loadpage(); //This should use the routing class instead. but for now it's here.
    }
    public function loadpage() {
        //This should use the routing class instead. but for now it's here.
        include("public/index.php");
    }
}
$kernel = new kernel();
$kernel->run();