@extends('layouts.dashboard')
@section('title', 'List Unit')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Unit</h4>

    <form class="mb-4" action="{{ url()->current() }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" id="navbarForm" placeholder="Search here..." value="{{ request('search') ?? '' }}">
            <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
            <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
        </div>
    </form>

    <x-table :header="['Nama Unit']">
        @foreach ($units as $unit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $unit->role }}</td>
            <td><a href="{{ route('presence.dsdm-civitas-per-unit-detail', $unit->id) }}">Detail</a></td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $units->links() }}
    </div>
</div>
@endsection