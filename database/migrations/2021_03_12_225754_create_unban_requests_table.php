<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnbanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unban_requests', function (Blueprint $table) {
            $table->id();
            $table->string("ban_type");
            $table->string("platform")->nullable();
            $table->string("email");
            $table->string("username");
            $table->string("uuid", 32)->nullable();
            $table->string("before_ban", 1000);
            $table->string("why_unban", 1000);
            $table->string("what_different", 1000);
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
        Schema::dropIfExists('unban_requests');
    }
}
