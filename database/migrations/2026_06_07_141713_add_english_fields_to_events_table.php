<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('title_en')
                  ->nullable()
                  ->after('title');

            $table->text('short_description_en')
                  ->nullable()
                  ->after('short_description');

            $table->text('full_description_en')
                  ->nullable()
                  ->after('full_description');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'short_description_en',
                'full_description_en',
            ]);
        });
    }
};