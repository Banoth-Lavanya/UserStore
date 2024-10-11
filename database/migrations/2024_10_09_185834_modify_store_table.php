<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store', function (Blueprint $table) {
            // Add userId as a foreign key referencing users.id
            $table->unsignedBigInteger('userId'); // Ensure this matches the type in users table
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('store', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropColumn('userId');
        });
    }
}
