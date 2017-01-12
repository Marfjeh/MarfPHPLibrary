<?php
//Load libs
require_once("./vendor/marfphplib/Marf/mff.class.php");
require_once("./vendor/marfphplib/MegaXLR/database.class.php");
require_once("./vendor/marfphplib/Marf/error.class.php");
require_once('./vendor/autoload.php'); //Yes we're going to use it...
//end libs


//database settings

//end database settings



class kernel {
    public function openDb() {
        $db = new Database();
    }

    public function runSQL($sql) {

    }

    public function Bootstrapper() {
        $this->pageloader();
    }


    public function pageloader() {
        /*
         * @Title MarfPhpLib PageLoader Kernel module
         * @Author Marvin Ferwerda
         * @Description This allows to load pages in the public/ folder, this is however used for a test.
         *              and will be removed in future releases. The proper way will be a file where you
         *              set the pages in a list, and a url like laravel.
         */

        if (isset($_GET["page"]))
        {
	        $pagina = $_GET["page"] . ".php";
            if (file_exists($pagina)) 
            {
	            //include($pagina);
                $loader = new Twig_Loader_Filesystem('./public');
                $twig = new Twig_Environment($loader, array(
                    'cache' => './cache',
                ));
                $template = $twig->loadTemplate($pagina);
                echo $template->render(array('name' => 'MarfPHPLibrary 0.2 Alpha'));

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
            echo("Warning: Not implemented right now");
        }

        if (isset($_GET['twigtest']))
        {
            $loader = new Twig_Loader_Array(array(
            'index' => 'Hello {{ name }}!',
            ));

            $twig = new Twig_Environment($loader);

            echo $twig->render('index', array('name' => 'MarfPhpLib'));
        }

        if(isset($_GET["page"]) == false && isset($_GET['db']) == false && isset($_GET['twigtest']) == false)
        {
            include("public/index.php");
        }
    }
}
$kernel = new kernel();
$kernel->Bootstrapper();
