@extends('layouts.app')

@section('content')
    <h1>Мои заметки</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('notes.create') }}" class="btn btn-primary">Создать заметку</a>

    @if ($notes->count() > 0)
        <ul>
            @foreach ($notes as $note)
                <li>
                    <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                    <a href="{{ route('notes.edit', $note) }}">Редактировать</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>

          {{ $notes->links() }} {{-- Пагинация --}}
    @else
        <p>У вас пока нет заметок.</p>
    @endif
@endsection