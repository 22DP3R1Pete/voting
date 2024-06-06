<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteUsersTable extends Migration
{
    public function up()
    {
        Schema::create('vote_users', function (Blueprint $table) {
            $table->unsignedBigInteger('vote_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Уникальный составной ключ
            $table->unique(['vote_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vote_users');
    }
}
