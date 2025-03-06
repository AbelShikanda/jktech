<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_service_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('services_id')->constrained('services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('service_categories_id')->constrained('service_categories')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('service_service_categories');
    }
}
