<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 48)->unique();
            $table->string('email');
            $table->enum('status', ['authorised', 'decline', 'refunded']);
            $table->integer('balance');
            $table->string('currency', 16);
            $table->string('provider', 36);
            $table->timestamp('created_at');
            $table->index('status');
            $table->index('balance');
            $table->index('currency');
            $table->index('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
