<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->string('file');
            $table->string('file_id');
            $table->string('thumbnail')->nullable();
            $table->string('type')->default('text');
            $table->integer('year');
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
        Schema::dropIfExists('past_questions');
    }
}
