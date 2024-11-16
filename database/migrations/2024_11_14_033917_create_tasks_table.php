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
            $table->string('title');
            $table->string('contents');
            $table->text('image_at')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->date('finish_date');
            $table->foreignId('color_id')->constrained('colors');
            $table->boolean('confirmed');
            $table->timestamps();
        });
// tasks テーブルに color_id カラムがあるか確認
Schema::table('tasks', function (Blueprint $table) {
    $table->foreignId('color_id')->constrained('colors');
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
