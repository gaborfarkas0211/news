<?php

namespace App\Http\Controllers;


use App\Http\Requests\NewsFilterRequest;
use App\Http\Resources\NewsdataResource;
use App\Services\NewsdataApiService;

class NewsController extends Controller
{
    public function index(NewsFilterRequest $request, NewsdataApiService $newsdataApiService)
    {
        $filters = $request->validated();
        $params = $this->createQueryParams($filters);
        $latestNewsData = collect($newsdataApiService->getLatestNews($params));
        $latestNews = (new NewsdataResource($latestNewsData))->jsonSerialize();

        $countries = config('newsdata.filters.country');
        $categories = config('newsdata.filters.category');
        $languages = config('newsdata.filters.language');

        return view('news.index',
            compact('latestNews', 'countries', 'categories', 'languages')
        );
    }

    protected function createQueryParams(array $filters): array
    {
        $params = [];
        foreach ($filters as $filter => $values) {
            $params[$filter] = implode(',', $values);
        }

        return $params;
    }
}
