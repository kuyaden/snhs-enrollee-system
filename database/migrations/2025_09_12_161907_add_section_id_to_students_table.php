<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Only add if column doesn't already exist
            if (!Schema::hasColumn('students', 'section_id')) {
                $table->unsignedBigInteger('section_id')->nullable();

                $table->foreign('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('set null');

            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'section_id')) {
                $table->dropForeign(['section_id']);
                $table->dropColumn('section_id');
            }
        });
    }
};
