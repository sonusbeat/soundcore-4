<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('artist_id')->unsigned()->index();
            $table->string('name', 200)->unique();
            $table->string('permalink', 200)->unique();
            $table->string('catalog')->unique();
            $table->string('upc')->unique();
            $table->string('isrc', 100)->unique();
            $table->date('released_at');
            $table->integer('tracks_quantity');
            $table->boolean('various_artists')->default(0);
            $table->string('genre', 100);
            $table->text('description');
            $table->string('coverart')->nullable();
            $table->string('coverart_alt')->nullable();
            $table->string('beatport')->nullable();
            $table->string('itunes')->nullable();
            $table->string('spotify')->nullable();
            $table->string('deezer')->nullable();
            $table->string('soundcloud')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('albums');
    }
}
