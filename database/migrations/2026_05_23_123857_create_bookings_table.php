<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('date');
            $table->time('time');
            $table->integer('guests_count');
            $table->enum('status', ['new', 'confirmed', 'cancelled', 'completed', 'guest_on_place'])->default('new');
            $table->text('internal_comment')->nullable();
            $table->integer('table_number')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};