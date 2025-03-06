<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeBaseImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_base_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('thumbnail')->nullable();
            $table->string('full')->nullable();
            $table->foreignId('knowledgeBases_id')->constrained('knowledge_bases');

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
        Schema::dropIfExists('knowledge_base_images');
    }
}
