<?php
namespace Lastfm;

use GuzzleHttp\Client as HttpClient;

class Client {

  private $apikey;
  private $httpclient;

  public function __construct($apikey, array $config = []) {
    $this->apikey = $apikey;
    $this->httpclient = new HttpClient($config);
  }

  public function request($methodName, $parameters = array()) {
    $query = array_merge([
      'api_key' => $this->apikey,
      'format' => 'json',
      'method' => $methodName,
    ], $parameters);
    $response = $this->httpclient->request('GET', 'http://ws.audioscrobbler.com/2.0/', [
      'query' => $query,
    ]);
    return $response;
  }

  public function callMethod($methodName, $parameters = array()) {
    $response = $this->request($methodName, $parameters);
    $body = (string) $response->getBody();
    return json_decode($body);
  }
}
