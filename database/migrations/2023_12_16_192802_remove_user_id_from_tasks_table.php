<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Törli a user_id-hez kapcsolódó külső kulcsot
            $table->dropColumn('user_id'); // Törli a user_id mezőt
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Ha esetleg vissza akarod állítani a migrációt
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Írd vissza a user_id mezőt
            $table->foreign('user_id')->references('id')->on('users'); // Írd vissza a külső kulcsot
        });
    }
}