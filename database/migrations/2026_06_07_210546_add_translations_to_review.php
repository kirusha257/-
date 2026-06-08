<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->text('text_en')->nullable();
        $table->text('author_en')->nullable();
    });
}

public function down()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropColumn([
            'text_en',
            'author_en'
        ]);
    });
}
};
