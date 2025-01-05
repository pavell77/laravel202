<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->paginate(10); // Получаем заметки текущего пользователя с пагинацией
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        Auth::user()->notes()->create($request->validated());
        return redirect()->route('notes.index')->with('success', 'Заметка успешно создана.');
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note); // Проверка авторизации
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note); // Проверка авторизации
        return view('notes.edit', compact('note'));
    }

    public function update(StoreNoteRequest $request, Note $note)
    {
        $this->authorize('update', $note); // Проверка авторизации
        $note->update($request->validated());
        return redirect()->route('notes.index')->with('success', 'Заметка успешно обновлена.');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note); // Проверка авторизации
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Заметка успешно удалена.');
    }
}