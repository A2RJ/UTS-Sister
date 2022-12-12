 <form action="{{ $action }}" method="post" onsubmit="return confirm('{{ $confirm }}')">
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-sm btn-outline-danger">{{ $text }}</button>
 </form>