<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->text('description');
            $table->enum("module_type", ["file", "youtube"]);
            $table->string("file_type")->nullable();
            $table->string("youtube")->nullable();
            $table->string("document")->nullable();
            $table->integer('order');
            $table->bigInteger('view')->default('0');
            $table->enum("status", ["active", "inactive"])->default("active");
            $table->foreign('course_id')->references('id')->on('courses');
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
        Schema::table('modules', function (Blueprint $table) {
            $table->dropForeign('modules_course_id_foreign');
        });
        Schema::dropIfExists('modules');
    }
}
