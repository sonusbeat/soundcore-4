<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('artist_name', 150)->unique();
            $table->string('permalink', 150)->unique();
            $table->string('image', 150)->nullable();
            $table->string('image_alt', 150)->unique()->default('no-user.jpg')->nullable();
            $table->string('email', 200)->unique();
            $table->string('nationality', 200);
            $table->text('biography');
            $table->string('facebook', 200)->unique()->nullable();
            $table->string('instagram', 200)->unique()->nullable();
            $table->string('twitter', 200)->unique()->nullable();
            $table->string('youtube', 200)->unique()->nullable();
            $table->string('soundcloud', 200)->unique()->nullable();
            $table->boolean('active')->default(0);
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->enum('meta_robots', [
                'index, follow',
                'noindex, follow',
                'index, nofollow',
                'noindex, nofollow',
            ])->default('noindex, nofollow')->nullable();
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
        Schema::dropIfExists('artists');
    }
}
