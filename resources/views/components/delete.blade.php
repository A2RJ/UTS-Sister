 <form action="{{ $action }}" method="post" onsubmit="return confirm('{{ $confirm }}')">
     @csrf
     @method('DELETE')
     <button type="submit">{{ $text }}</button>
 </form>