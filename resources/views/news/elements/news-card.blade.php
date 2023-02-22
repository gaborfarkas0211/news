<div class="col">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">{{ $item['title'] }}</h5>
            <p class="card-text">{{ $item['description'] }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ $item['link'] }}" class="btn btn-sm btn-outline-secondary">Read more</a>
            <small class="text-muted">{{ $item['published_at'] }}</small>
            <form action="{{ route('news.publish') }}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $item['title'] }}">
                <input type="hidden" name="description" value="{{ $item['description'] }}">
                <input type="hidden" name="link" value="{{ $item['link'] }}">
                <input type="hidden" name="published_at" value="{{ $item['published_at'] }}">
                <button type="submit" class="btn btn-sm btn-primary">Publish</button>
            </form>
        </div>
    </div>
</div>
