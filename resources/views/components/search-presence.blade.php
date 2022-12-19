<form class="mb-4" action="{{ url()->current() }}" method="GET">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="{{ request('search')}}" placeholder="Search..." autocomplete="off">
        @if (Request::is('presence/structural-all') || Request::is('presence/my-presence'))
        <input type="date" name="start" class="form-control" value="{{ request('start')}}">
        <input type="date" name="end" class="form-control" value="{{ request('end')}}">
        @endif
        <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
        <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
        <button type="reset" class="btn btn-sm btn-outline-primary">Export</button>
    </div>
</form>