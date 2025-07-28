<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);

            $table->enum('duration_unit', ['day', 'week', 'month', 'year']);
            $table->integer('duration');

            $table->boolean('is_active')->default(true);
            $table->boolean('is_recurring')->default(false);

            $table->integer('trial_days')->default(0);

            $table->string('type')->nullable();

            $table->json('features')->nullable();  // ⭐ e.g. ['Unlimited Ads', 'Classroom Access']

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
        Schema::dropIfExists('bundles');
    }
}
