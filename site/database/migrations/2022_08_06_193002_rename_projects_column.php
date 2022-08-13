<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProjectsColumn extends Migration{

    /**
     * >When Run this migration rename the column project_name to project_title in projects table
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table){
            $table->renameColumn('project_name', 'project_title');
        });
    }

    /**
     * > We're renaming the column `project_title` to `project_name` in the `projects` table
     * @return void
     */
    public function down(){
        Schema::table('projects', function(Blueprint $table){
            $table->renameColumn('project_title', 'project_name');
        });
    }
}
