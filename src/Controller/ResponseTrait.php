<?php
namespace App\Controller;

use App\Http\Response;

trait ResponseTrait
{
    public function response($data): object
    {
        return Response::response($data);
    }
}