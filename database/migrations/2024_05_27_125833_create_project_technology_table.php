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
        Schema::create('project_technology', function (Blueprint $table) {

            //Tabella project
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
            ->references('id')
            ->on('project')
            ->cascadeOnDelete();


            //Tabella Technologt
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
            ->references('id')
            ->on('technology')
            ->cascadeOnDelete();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
