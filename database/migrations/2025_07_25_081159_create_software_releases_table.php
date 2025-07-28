<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('software_id')->constrained()->onDelete('cascade');
            $table->string('os');  // 'windows', 'mac', 'linux', etc.
            $table->string('version');
            $table->string('download_url');  // direct file or storage path
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
        Schema::dropIfExists('software_releases');
    }
}
