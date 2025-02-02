<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (!Schema::hasColumn('attendances', 'student_id')) {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('attendances', 'student_id')) {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('student_id');
        });
    }
}

    };
