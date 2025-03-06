<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_bases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('knowledgeBase_categories_id')->constrained('knowledge_base_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('sub_title');
            $table->text('body');
            $table->string('slug');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
            $table->tinyInteger('whatsapp')->default(0);
            $table->tinyInteger('telegram')->default(0);
            $table->tinyInteger('website')->default(0);

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
        Schema::dropIfExists('knowledge_bases');
    }
}
