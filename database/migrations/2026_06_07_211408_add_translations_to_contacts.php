<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->text('address_en')->nullable();
        $table->text('work_hours_en')->nullable();
    });
}

public function down()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->dropColumn([
            'address_en',
            'work_hours_en'
        ]);
    });
}
};
