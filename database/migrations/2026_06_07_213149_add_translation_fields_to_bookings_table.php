<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('guest_name_en')->nullable()->after('guest_name');
            $table->text('internal_comment_en')->nullable()->after('internal_comment');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['guest_name_en', 'internal_comment_en']);
        });
    }
};
