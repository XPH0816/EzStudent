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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('product_id')->after('id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->after('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('otp', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['customer_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::table('otp', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
    }
};
