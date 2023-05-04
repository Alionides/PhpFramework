<?php
use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

use App\Model\Database;
new Database();

$kernel = new Kernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request,$response);
