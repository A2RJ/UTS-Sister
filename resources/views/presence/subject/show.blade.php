@extends('layouts.dashboard')

@section('title', 'List Jadwal Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jadwal pertemuan: {{ $subject->subject }} ({{ $subject->sks}} SKS)</h4>

    <x-success-message />
    <x-error-message />
    @php
    $action = collect(['Pertemuan' , 'Tanggal', 'Jam Dimulai', 'Foto', 'Link (Click to copy)']);
    if(auth()->user()->isStudyProgram()){
    $action->push('Aksi');
    }
    @endphp
    <x-table :header="$action">
        @foreach ($meetings as $meeting)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $meeting->meeting_name }}</td>
            <td>{{ $meeting->date }}</td>
            <td>{{ $meeting->meeting_start }}</td>
            <td>
                @if ($meeting->file)
                <a href="#{{ $meeting->file }}">Foto</a>
                @endif
            </td>
            <td>
                @if ($meeting->url)
                <p id="textToCopy" onclick="copyText()">
                    {{$meeting->url->link}}
                </p>
                @endif
            </td>
            @if (auth()->user()->isStudyProgram())
            <td>
                <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-sm btn-outline-warning mr-1 mb-1">Edit</a>
                <x-delete action="{{ route('meeting.destroy', $meeting->id) }}" />
            </td>
            @endif
        </tr>
        @endforeach
    </x-table>
</div>

<script>
    function copyText() {
        var copyTextElement = document.getElementById("textToCopy");
        var text = copyTextElement.textContent;

        var input = document.createElement("input");
        input.value = text;
        document.body.appendChild(input);

        input.select();
        document.execCommand("copy");
        alert("Text has been copied to clipboard");

        document.body.removeChild(input);
    }
</script>
@endsection