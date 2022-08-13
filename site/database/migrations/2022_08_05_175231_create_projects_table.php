<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     * 
     * This function creates a table called projects with the following columns: id, project_name,
     * project_desc, project_link, project_image, and timestamps
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_name');
            $table->string('project_desc');
            $table->string('project_link');
            $table->string('project_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * If the projects table exists, drop it.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
