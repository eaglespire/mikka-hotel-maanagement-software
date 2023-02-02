<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('siteName')->nullable();
            $table->string('favicon')->nullable();
            $table->string('whiteLogo')->nullable();
            $table->string('darkLogo')->nullable();
            $table->string('frontCopyright')->nullable();
            $table->string('backCopyright')->nullable();
            $table->string('firstPhoneNumber')->nullable();
            $table->string('secondPhoneNumber')->nullable();
            $table->string('firstAddress')->nullable();
            $table->string('secondAddress')->nullable();
            $table->string('firstEmail')->nullable();
            $table->string('secondEmail')->nullable();
            $table->string('facebookID')->nullable();
            $table->string('twitterID')->nullable();
            $table->string('instagramID')->nullable();
            $table->string('linkedinID')->nullable();
            $table->string('youtubeID')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('siteHeaderInfo')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
