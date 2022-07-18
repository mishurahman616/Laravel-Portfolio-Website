<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Create the courses table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_name');
            $table->string('course_desc');
            $table->string('course_fee');
            $table->string('course_total_enroll');
            $table->string('course_total_class');
            $table->string('course_link');
            $table->string('course_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drop the course table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
