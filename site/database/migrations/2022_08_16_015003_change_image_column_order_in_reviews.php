<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
           $table->renameColumn('image', 'imageT');

        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('image')->after('desc');
 
         });
        DB::table('reviews')->update([
            'image'=>DB::raw('imageT')
        ]);
        Schema::table('reviews', function(Blueprint $table)
        {
            $table->dropColumn('imageT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('image', 'imageT');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('image')->after('updated_at');
        });
        DB::table('reviews')->update([
            'image'=>DB::raw('imageT')
        ]);
        Schema::table('reviews', function(Blueprint $table)
        {
            $table->dropColumn('imageT');
        });
    }
};
