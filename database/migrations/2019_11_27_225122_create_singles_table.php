<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('artist_id')->index();
            $table->string('title');
            $table->string('permalink')->unique();
            $table->string('feat', 100)->nullable();
            $table->string('version', 100)->default('Original Mix');
            $table->string('genre', 100);
            $table->string('catalog', 100)->unique();
            $table->string('upc', 100)->unique();
            $table->string('isrc', 100)->unique();
            $table->date('released_at');
            $table->text('description', 512);
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
            ]);
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
        Schema::dropIfExists('singles');
    }
}
