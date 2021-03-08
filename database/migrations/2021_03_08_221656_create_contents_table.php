<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Content;
use Illuminate\Support\Str;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->longText('content');
            $table->timestamps();
        });

        $content = new Content;
        $content->slug = Str::of('rules-game');
        $content->name = "Game Rules";
        $content->content = "";
        $content->save();

        $content = new Content;
        $content->slug = Str::of('rules-afk');
        $content->name = "AFK Rules";
        $content->content = "";
        $content->save();

        $content = new Content;
        $content->slug = Str::of('rules-alt');
        $content->name = "Alt Rules";
        $content->content = "";
        $content->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
