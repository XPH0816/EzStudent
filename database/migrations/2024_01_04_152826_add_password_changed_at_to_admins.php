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
        if(!Schema::hasColumn('admins', 'password_changed_at')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->timestamp('password_changed_at')->nullable()->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('admins', 'password_changed_at')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('password_changed_at');
            });
        }
    }
};
