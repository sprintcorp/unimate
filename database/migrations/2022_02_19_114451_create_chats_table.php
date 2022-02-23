<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('receiver_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('course_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('group_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('university_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->text('message');
            $table->string('type');
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
        Schema::dropIfExists('chats');
    }
}
