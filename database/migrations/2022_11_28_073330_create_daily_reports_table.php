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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->string('task_id');
            $table->string('employee_id');
            $table->text('description');
            $table->date('date');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->float('total_minutes')->nullable();
            $table->text('blockers')->nullable();
            $table->text('todo')->nullable();
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
        Schema::dropIfExists('daily_reports');
    }
};
