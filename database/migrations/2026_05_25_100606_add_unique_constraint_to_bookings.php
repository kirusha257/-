<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->unique(['table_number', 'date', 'time'], 'unique_booking');
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropUnique('unique_booking');
    });
}
};
