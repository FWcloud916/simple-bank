<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('account_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('amount');
            $table->enum('type', ['withdraw', 'deposit']);
            $table->unsignedBigInteger('balance');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account_records');
    }
};
