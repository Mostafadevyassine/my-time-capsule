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
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('message');
            $table->datetime('reveal_date');
            $table->string('country')->nullable();
            $table->enum('mood',['happy','sad','Excited','Angry','Lonely','Tired','Bored','Calm'])->nullable();
            $table->enum('privacy',['public','private']);
            $table->boolean('is_surprise')->default(false);
            $table->boolean('is_revealed')->default(false);
            $table->string('file_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');

    }
};
