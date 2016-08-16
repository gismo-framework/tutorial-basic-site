<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 05.08.16
 * Time: 23:31
 */

require __DIR__ . "/../../../vendor/autoload.php";
require __DIR__ . "/../../../../gismo/vendor/autoload.php";

ini_set("display_errors", 1);



$context = new \Gismo\Tutorial\Context\Frontend\FrontendContext();

$plugin = new \Gismo\Tutorial\Plugin\Homepage\HomepagePlugin();
$plugin->onContextInit($context);


$plugin = new \Gismo\Tutorial\Plugin\Guestbook\GuestbookPlugin();
$plugin->onContextInit($context);


$request = \Gismo\Component\HttpFoundation\Request\RequestFactory::BuildFromEnv();
$routeRequest = \Gismo\Component\Route\Type\RouterRequest::BuildFromRequest($request);


$context->route->dispatch($routeRequest);