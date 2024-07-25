<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();

            $table->string('identifier');
            $table->string('token');
            $table->dateTime('expires_at');

            $table->timestamps();
        });
    }
};
