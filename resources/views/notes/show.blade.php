@extends('layouts.app')

@section('content')
    <h1>{{ $note->title }}</h1>

    <p>{{ $note->content }}</p>

    <a href="{{ route('notes.edit', $note) }}" class="btn btn-primary">Редактировать</a>
    <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
    </form>
    <a href="{{ route('notes.index') }}" class="btn btn-secondary mt-3">Назад к списку заметок</a>
@endsection