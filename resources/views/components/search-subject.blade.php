<form class="mb-4" action="{{ url()->current() }}" method="GET">
    <div class="input-group">
        <input type="text" name="search" class="form-control" id="navbarForm" placeholder="Search here..." value="{{ request('search') ?? '' }}">
        <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
        <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
        <button type="reset" class="btn btn-sm btn-outline-primary">Export</button>
    </div>
</form>