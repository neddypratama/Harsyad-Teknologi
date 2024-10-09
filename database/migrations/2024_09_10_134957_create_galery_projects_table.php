<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galery_projects', function (Blueprint $table) {
            $table->id('galery_id');
            $table->string('galery_name');
            $table->unsignedBigInteger('project_id')->index();
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galery_projects');
    }
};
