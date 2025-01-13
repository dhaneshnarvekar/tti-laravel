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
            $table->id();
            //$table->foreign('project_id')->references('id')->on('projects');
            $table->foreignId('project_id')->constrained('projects'); // this is a simple way to achieve the same as above line
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->string('assigned_to',255)->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['to_do', 'in_progress','done'])->default('to_do'); // enum can be avoided using traits or const array in models
            $table->timestamps();
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
