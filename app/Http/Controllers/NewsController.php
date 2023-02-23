<?php

namespace App\Http\Controllers;


use App\Events\NewsPublished;
use App\Http\Requests\NewsFilterRequest;
use App\Http\Requests\PublishNewsRequest;
use App\Http\Resources\NewsdataResource;
use App\Models\News;
use App\Services\NewsdataApiService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function index(NewsFilterRequest $request, NewsdataApiService $newsdataApiService): View
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

    public function publish(PublishNewsRequest $request): RedirectResponse
    {
        $news = News::create($request->validated());
        NewsPublished::dispatch($news);

        return redirect()->back()->with('success', "News published successfully [{$news->title}]");
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
