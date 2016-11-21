<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tristan LASALLE <t.lasalle@deadia.fr>
 * Date: 10/10/16
 * Time: 16:04
 */

require('vendor/autoload.php');

$router = new \Gears\Router();
$router->routesPath = 'src/EServicial/Config/Router.php';
$router->dispatch();
