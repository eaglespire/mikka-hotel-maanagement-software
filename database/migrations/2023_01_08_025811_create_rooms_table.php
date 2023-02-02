
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->integer('roomNumber')->unique();
            $table->text('extraInfo')->nullable();
            $table->decimal('price',24)->nullable();
            $table->boolean('roomClean')->default(true);
            $table->boolean('roomBooked')->default(false);
            $table->boolean('roomShown')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
