<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('artist_id')->unsigned()->index();
            $table->integer('album_id')->unsigned()->default(0)->index();
            $table->string('title', 200)->unique();
            $table->string('permalink', 200)->unique();
            $table->string('version', 20)->default('original mix');
            $table->string('catalog', 100);
            $table->string('upc', 150);
            $table->string('isrc', 150);
            $table->date('released_at');
            $table->string('genre');
            $table->string('time', 6);
            $table->string('bpm', 4);
            $table->string('key', 8);
            $table->string('secondary_genre');
            $table->string('coverart')->nullable()->default('no-image.jpg');
            $table->string('coverart_alt')->nullable()->default('No Image');
            $table->string('description');
            $table->string('beatport')->nullable();
            $table->string('traxsource')->nullable();
            $table->string('juno')->nullable();
            $table->string('meta_title', 70);
            $table->enum('meta_robots', [
                'index, follow',
                'noindex, follow',
                'index, nofollow',
                'noindex, nofollow',
            ])->default('noindex, nofollow');
            $table->string('meta_description', 160);
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('stems');
    }
}
