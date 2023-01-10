<form method="POST" enctype="multipart/form-data" action="{{ route('student.import.post') }}">
    @csrf
    <input type="file" name="excel">
    <button type="submit">Upload</button>
</form>