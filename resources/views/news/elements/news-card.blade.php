<div class="col">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">{{ $item['title'] }}</h5>
            <p class="card-text">{{ $item['description'] }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ $item['link'] }}" class="btn btn-sm btn-outline-secondary">Read more</a>
            <small class="text-muted">{{ $item['published_at'] }}</small>
            <button class="btn btn-sm btn-primary">Publish</button>
        </div>
    </div>
</div>
