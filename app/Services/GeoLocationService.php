<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GeoLocationService {
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function getLocation($ip)
    {
        try {
            $response = $this->httpClient->get("https://ipinfo.io/{$ip}/json");
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error (e.g., log it, return a default value, etc.)
            return ['error' => 'Unable to retrieve location data.'];
        }
    }
}

?>
