<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // ID der Aufgabe
            $table->string('title'); // Titel der Aufgabe
            $table->text('description'); // Beschreibung
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Wichtigkeit
            $table->date('due_date')->nullable(); // Fälligkeitsdatum
            $table->boolean('completed')->default(false); // erledigt/ nicht erledigt
            $table->timestamps(); // created_at/updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
