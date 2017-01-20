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
    public $pagina;
    public $loaded_page;

    public function __construct() {
        $this->pagina = $_GET['pagina'];
    }

    public function openDb() {
        $db = new Database();
    }

    public function runSQL($sql) {

    }

    public function Bootstrapper() {
        include ('route.php');
        include ('config/config.php');
    }

    public function pageloader($pagina2, $var = array())
    {
        if (file_exists("./public/" . $pagina2))
        {
            $loader = new Twig_Loader_Filesystem('./public');
            $twig = new Twig_Environment($loader, array(
                'cache' => './cache',
            ));
            $template = $twig->loadTemplate($pagina2);
            echo $template->render($var);

        }
        else
        {
            include("error/404.php");
        }
    }
}
$kernel = new kernel();
$kernel->Bootstrapper();
