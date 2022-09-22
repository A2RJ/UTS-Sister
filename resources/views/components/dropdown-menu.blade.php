<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#dropdown{{ $details['id'] }}" role="button" aria-expanded="false"
        aria-controls="dropdown{{ $details['id'] }}">
        <i class="link-icon" data-feather="mail"></i>
        <span class="link-title">{{ $details['name'] }}</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="dropdown{{ $details['id'] }}">
        <ul class="nav sub-menu">
            @foreach ($details['children'] as $item)
                <li class="nav-item">
                    <a href="{{ $item['link'] }}" class="nav-link">{{ $item['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
