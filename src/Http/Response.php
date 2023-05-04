<?php
namespace App\Http;
use Symfony\Component\HttpFoundation\Response as Responses;

class Response
{
    public static function response($data): Responses
    {
        $response = new Responses();
        $response->setContent(json_encode([
            'data'=>$data
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}