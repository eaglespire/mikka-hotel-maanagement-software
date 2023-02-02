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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('heroImage')->nullable();
            $table->string('firstSectionFirstImage')->nullable();
            $table->string('firstSectionSecondImage')->nullable();
            $table->string('firstSectionFirstTitle')->nullable();
            $table->string('firstSectionFirstSubTitle')->nullable();
            $table->longText('firstSectionFirstBody')->nullable();
            $table->longText('firstSectionSecondBody')->nullable();

            $table->string('secondSectionImage')->nullable();
            $table->string('secondSectionTitle')->nullable();
            $table->string('secondSectionSubTitle')->nullable();
            $table->longText('secondSectionBody')->nullable();

            $table->string('thirdSectionImage')->nullable();
            $table->string('thirdSectionTitle')->nullable();
            $table->string('thirdSectionSubTitle')->nullable();
            $table->longText('thirdSectionFirstBody')->nullable();
            $table->longText('thirdSectionSecondBody')->nullable();
            $table->string('thirdSectionButtonText')->nullable();
            $table->string('thirdSectionButtonUrl')->nullable();

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
        Schema::dropIfExists('abouts');
    }
};
