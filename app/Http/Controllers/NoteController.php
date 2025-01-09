<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->paginate(10);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        Auth::user()->notes()->create(array_merge($request->validated(), ['user_id' => Auth::id()]));
        return redirect()->route('notes.index')->with('success', 'Заметка успешно создана.');
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note); // Проверка авторизации через Policy
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note); // Проверка авторизации через Policy
        return view('notes.edit', compact('note'));
    }

    public function update(StoreNoteRequest $request, Note $note)
    {
        // Проверка, принадлежит ли заметка текущему пользователю
        if ($note->user_id !== Auth::id()) {
            abort(403, 'У вас нет прав на редактирование этой заметки.'); // Более информативное сообщение
        }

        $note->update($request->validated());
        return redirect()->route('notes.index')->with('success', 'Заметка успешно обновлена.');
    }

    public function destroy(Note $note)
    {
        // Проверка, принадлежит ли заметка текущему пользователю
        if ($note->user_id !== Auth::id()) {
            abort(403, 'У вас нет прав на удаление этой заметки.'); // Более информативное сообщение
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Заметка успешно удалена.');
    }
}