<?php

namespace App\Services;

use NewsdataIO\NewsdataApi;

class NewsdataApiService
{
    private NewsdataApi $newsdataApi;

    public function __construct(string $apiKey)
    {
        $this->newsdataApi = new NewsdataApi($apiKey);
    }

    public function getLatestNews(array $params = []): object|array
    {
        return $this->newsdataApi->get_latest_news($params);
    }
}
