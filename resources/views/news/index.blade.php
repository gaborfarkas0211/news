@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>News Filters</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('news.index') }}" method="GET" id="latest-news-filter">
                    <div class="row mb-3">
                        <x-multi-filter-select label="Country" name="country" :options="$countries"
                                               :selected="request('country', [])" lang-file="countries"/>
                        <x-multi-filter-select label="Category" name="category" :options="$categories"
                                               :selected="request('category', [])" lang-file="categories"/>
                        <x-multi-filter-select label="Language" name="language" :options="$languages"
                                               :selected="request('language', [])" lang-file="languages"/>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div class="btn-toolbar">
                    <button form="latest-news-filter" type="submit" class="btn btn-primary mx-2">Apply Filters</button>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary float-end">Reset</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Latest news</h4>
                @if(isset($latestNews['totalResults']))
                    <span>Total Results: {{ $latestNews['totalResults'] }}</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @forelse($latestNews['results'] as $item)
                        @include('news.elements.news-card', $item)
                    @empty
                        <div class="col d-flex justify-content-center">
                            <h5>No results found</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/news.js'])
@endsection
