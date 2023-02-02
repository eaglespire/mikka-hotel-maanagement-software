<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feature_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('room_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_room');
    }
};
