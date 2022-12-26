<form class="mb-4" action="{{ url()->current() }}" method="GET">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="{{ request('search')}}" placeholder="Search..." autocomplete="off">
        @if ($withDate)
        <input type="date" name="start" class="form-control" value="{{ request('start')}}">
        <input type="date" name="end" class="form-control" value="{{ request('end')}}">
        @endif
        <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
        <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
        @if ($exportUrl)
        <a href="{{ $exportUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">Export</a>
        @endif
    </div>
</form>