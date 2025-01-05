@extends('layouts.app')

@section('content')
    <h1>Редактировать заметку</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.update', $note) }}" method="POST">
        @csrf
        @method('PUT') {{-- Важно указать метод PUT для обновления --}}

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $note->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $note->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>

     <a href="{{ route('notes.index') }}" class="btn btn-secondary mt-3">Назад к списку заметок</a>
@endsection