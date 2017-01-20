<?php
/*
 * @title MarfPhpLib Routing page.
 * @description This will be loaded into the kernel level itself, Here you can add your pages, put your vars when needed. or use the fallback system.
 */
require_once ('kernel.php'); //just in case...
$kernel = new kernel(); //define teh kernel

if ($kernel->pagina == null || $kernel->pagina == "index")
{
    $kernel->pageloader("index.php", array(
        'name' => 'MarfPhpLib 0.3 Alpha',
    ));
}
else if ($kernel->pagina == "Test2")
{
    $kernel->pageloader("marfjeh.php", array(
        'name' => 'MarfPhpLib 0.3 Alpha',
    ));
}
else
{
    $kernel->pageloader($kernel->pagina, array(
        'name' => 'MarfPhpLib 0.3 alpha'
    ));
}