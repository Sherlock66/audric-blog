<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('image');
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->string('url')->nullable();
            $table->string('enterprise')->nullable();
            $table->timestamp('created_at');
            
            $table->foreign('category_id')->references('id')->on('category_projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
