<?php

namespace App\Model;

use Illuminate\Database\Capsule\Manager as Capsules;

class Database {
    public function __construct(){
        $capsule = new Capsules;

        $capsule->addConnection([
            'driver' => $_ENV['DB_CONNECTION'],
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',

        ]);
        $capsule->bootEloquent();
    }
}