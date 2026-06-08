<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('gallery', function (Blueprint $table) {
        $table->text('title_en')->nullable();
        $table->text('description_en')->nullable();
    });
}

public function down()
{
    Schema::table('gallery', function (Blueprint $table) {
        $table->dropColumn([
            'title_en',
            'description_en'
        ]);
    });
}
};
