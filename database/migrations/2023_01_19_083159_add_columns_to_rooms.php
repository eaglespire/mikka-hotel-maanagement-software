<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('f1_public_id')->nullable();
            $table->string('f2_public_id')->nullable();
            $table->string('f3_public_id')->nullable();
            $table->string('f4_public_id')->nullable();
            $table->string('f5_public_id')->nullable();
            $table->string('f6_public_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['f1_public_id','f2_public_id','f3_public_id','f4_public_id','f5_public_id','f6_public_id']);
        });
    }
};
