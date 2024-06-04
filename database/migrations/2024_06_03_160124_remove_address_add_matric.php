<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(Schema::hasColumn('customers', 'address')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('address');
            });
        }
        if(!Schema::hasColumn('customers', 'matric')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('matric')->after('phoneNo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('customers', 'matric')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('matric');
            });
        }
        if(!Schema::hasColumn('customers', 'address')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('address')->after('phoneNo');
            });
        }
    }
};
