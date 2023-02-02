<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('firstImage')->nullable();
            $table->string('secondImage')->nullable();
            $table->string('thirdImage')->nullable();
            $table->string('fourthImage')->nullable();
            $table->string('fifthImage')->nullable();
            $table->string('sixthImage')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['firstImage','secondImage','thirdImage','fourthImage','fifthImage','sixthImage']);
        });
    }
};
