@foreach ($menu as $item)
    @if ($item['type'] === 'dropdown')
        <x-dropdown-menu :details="$item"></x-dropdown-menu>
    @elseif ($item['type'] === 'single')
        <x-single-menu :details="$item"></x-single-menu>
    @endif
@endforeach
