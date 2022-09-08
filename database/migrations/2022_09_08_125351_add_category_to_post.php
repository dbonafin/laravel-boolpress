<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Posts', function (Blueprint $table) {
            // Create category id column in posts table
            $table->unsignedBigInteger('category_id')->after('content')->nullable();
            // Create relationship between posts and categories        
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Posts', function (Blueprint $table) {
            // Reverse the process flow of the function up()
            // Delete the relationship
            $table->dropForeign('posts_category_id_foreign');
            // Delete the column
            $table->dropColumn('category_id');
        });
    }
}
