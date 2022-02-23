<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('university_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('faculty_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('department_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('other_name')->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
