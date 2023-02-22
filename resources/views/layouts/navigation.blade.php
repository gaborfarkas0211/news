@auth
    <div class="col-lg-3 text-end">
        <div class="d-inline">
            @if (auth()->user()->isAdmin())
                <a href="/" class="btn btn-outline-light me-2">Home</a>
                <a href="{{ route('news.index') }}" class="btn btn-outline-light me-2">News</a>
            @endif
        </div>
        <div class="dropdown d-inline position-static">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        Logout
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
@else
    <div class="col-lg-3 text-end">
        <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
    </div>
@endauth
