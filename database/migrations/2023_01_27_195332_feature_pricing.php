<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feature_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('pricing_id')->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_pricing');
    }
};
