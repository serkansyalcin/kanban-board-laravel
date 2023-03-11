<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->text('task');
            $table->string('creator');
            $table->string('description');
            $table->string('assignees');
            $table->string('deadline_date');
            $table->string('deadline_time');
            $table->string('priority'); //
            $table->string('status');
            $table->string('tags');
            $table->timestamps();

            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
