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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('owner_user_id');
            $table->string('nik');
            $table->string('name_prefix');
            $table->string('name');
            $table->string('name_suffix');
            $table->string('phone');
            $table->string('email');
            $table->string('gender');
            $table->string('birth_date');
            $table->string('birth_place');
            $table->string('position_id');
            $table->string('last_education');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('main_address_id');
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
        Schema::dropIfExists('employees');
    }
};
