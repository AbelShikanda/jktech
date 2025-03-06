<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeKnowledgeBaseImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_knowledge_base_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('knowledgeBases_id')->constrained('knowledge_bases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('knowledgeBase_images_id')->constrained('knowledge_base_images')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('knowledge_knowledge_base_images');
    }
}
