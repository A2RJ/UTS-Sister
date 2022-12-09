@if ($displayError === "true")
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endif

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ $slot }}

    <div class="d-flex justify-content-end">
        <button class="btn float-right btn-primary btn-lg" type="submit">Submit</button>
    </div>
</form>