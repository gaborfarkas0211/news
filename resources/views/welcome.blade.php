@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col"><h1>Published news</h1></div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4" id="news-container">
                @foreach($latestNews as $item)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{!! $item->description !!}</p>
                                <hr>
                                <p class="card-text">Accent Ratio Index: {{ $item->accent_ratio_index }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <small class="text-muted">{{ $item->created_at->format('Y. m. d. H:i:s') }}</small>
                                <a href="{{ $item->link }}" target="_blank" class="btn btn-sm btn-primary">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($latestNews->isEmpty())
                <div class="row py-3" id="empty-news">
                    <div class="col d-flex justify-content-center">
                        <h5>No results found</h5>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/news_subscriber.js'])
@endsection
