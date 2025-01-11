<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Note; // Импортируем модель Note
use App\Models\User; // Импортируем модель User

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('content'); // Добавляем столбец user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Добавляем внешний ключ
        });

        // Заполняем user_id для существующих заметок (ВАЖНО!)
        foreach (Note::all() as $note) {
            // Предполагаем, что все существующие заметки принадлежат текущему авторизованному пользователю
            // В РЕАЛЬНОМ ПРИЛОЖЕНИИ ВАМ НУЖНО БУДЕТ ОПРЕДЕЛИТЬ КОРРЕКТНОГО ПОЛЬЗОВАТЕЛЯ ДЛЯ КАЖДОЙ ЗАМЕТКИ
            $firstUser = User::first(); // Получаем первого пользователя из таблицы users (для примера)
            if($firstUser){
                $note->user_id = $firstUser->id;
                $note->save();
            } else {
                // Обработка ситуации, когда нет ни одного пользователя
                $note->delete(); // Удаляем заметку, если нет пользователя
            }
        }
    }

    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Удаляем внешний ключ
            $table->dropColumn('user_id'); // Удаляем столбец user_id
        });
    }
};