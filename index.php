<?php

//require autoloader
require './vendor/autoload.php';
// requiring symfony dom crawler
use Symfony\Component\DomCrawler\Crawler;

// http://localhost:8081/web_scraping

$dateFrom = '2019-03-01';
$dateTo = '2019-03-31';

// url
$url = 'https://www.mdjsjeux.ma/results/search';
// guzzle client
$client = new \GuzzleHttp\Client();

// get response data
// $response = $client->request('GET', $url);

//call the response
$response = $client->post($url, [
    'json' => [
        'dateFrom' => $dateFrom,
        'dateTo' => $dateTo,
        'gameId' => '5196',
        'page' => 0
    ]
]);
$pagesCount = 0;

if($response->getStatusCode() == 200){
    $pagesCount = ((int)json_encode(json_decode((string) $response->getBody())->attrs->totalPages));
}else{
    echo 'Status code: ' . $response->getStatusCode() . '; Something went wrong while getting pages total count!!';
}

$results =   json_decode((string)$response->getBody())->attrs;

echo print_r($results->items[0]);