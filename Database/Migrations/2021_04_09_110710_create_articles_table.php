<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->foreignId('category_id');
            $table->string('description');
            $table->string('cover')->nullable();
            $table->json('pictures')->nullable();
            $table->text('content');
            $table->boolean('status');
            $table->integer('clicks')->default(0)->unsigned();
            $table->integer('order')->default(0)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
