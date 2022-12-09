<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ $slot }}

    <div class="d-flex justify-content-end">
        <button class="btn float-right btn-primary btn-lg" type="submit">Submit</button>
    </div>
</form>