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
        Schema::create('apprentices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('cell_number', 20);

            $table->unsignedBigInteger('course_id')->nullable();

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->unsignedBigInteger('computer_id')->nullable();

            $table->foreign('computer_id')
                ->references('id')
                ->on('computers')
                ->onDelete('set null')
                ->onUpdate('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprentices');
    }
};
