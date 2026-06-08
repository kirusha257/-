<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('staff', function (Blueprint $table) {
        $table->string('name_en')->nullable();
        $table->text('position_en')->nullable();
    });
}

public function down()
{
    Schema::table('staff', function (Blueprint $table) {
        $table->dropColumn([
            'name_en',
            'position_en'
        ]);
    });
}
};
