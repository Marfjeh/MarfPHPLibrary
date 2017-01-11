<?php
error_reporting(1);

//Load libs
require_once("./lib/mff.class.php");
require_once("./lib/database.class.php");
require_once("./lib/error.class.php");
//require_once("./lib/route.class.php");
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
        if (isset($_GET["page"]))
        {
	        $pagina = $_GET["page"] . ".php";
            if (file_exists($pagina)) 
            {
	            include("public/" . $pagina);
            }
            else
            {
                include("error/404.php");
            }
        }

        //Database Page Fetcher
        //This allows to load a page stored in MySQL database. this will only load the page and can't do anything to it. This however will use a diffrent Get request name
        if(isset($_GET['db']))
        {
            echo("Not implemented right now");
        }

        if(isset($_GET['debug']))
        {
            echo (ini_get('display_errors'));
        }


        if(isset($_GET["page"]) == false && isset($_GET['db']) == false && isset($_GET['debug']) == false)
        {
            include("public/index.php");
        }
    }
}
$kernel = new kernel();
$kernel->run();