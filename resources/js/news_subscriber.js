var channel = window.Pusher.subscribe('news-published');

channel.bind('App\\Events\\NewsPublished', function (event) {
    const emptyNews = document.getElementById('empty-news');
    if (null !== emptyNews) {
        emptyNews.remove();
    }

    const news = event.news;
    const newsContainer = document.getElementById('news-container');

    const cardElement = createNewsCardElement(news);
    newsContainer.insertAdjacentHTML('afterbegin', cardElement);
});

function createNewsCardElement(news) {
    return `
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">${news.title}</h5>
                <p class="card-text">${news.description ?? ''}</p>
                <hr>
                <p class="card-text">Accent Ratio Index: ${news.accent_ratio_index}</p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <small class="text-muted">${new Date(news.created_at).toLocaleString('hu')}</small>
                <a href="${news.link}" target="_blank" class="btn btn-sm btn-primary">Read More</a>
            </div>
        </div>
    </div>
  `;
}
