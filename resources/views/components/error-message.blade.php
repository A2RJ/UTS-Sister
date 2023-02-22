@if(session()->has('error'))
<div class="alert alert-success">
    {{ session()->get('error') }}
</div>
@endif