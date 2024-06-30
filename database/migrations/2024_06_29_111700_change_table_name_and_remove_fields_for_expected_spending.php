<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expected_spendings', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['month', 'year']);
        });

        Schema::rename('expected_spendings', 'budget_categories');

        Schema::table('budget_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('budget_categories');
        });
    }

    public function down(): void
    {
        Schema::table('budget_categories', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::rename('budget_categories','expected_spendings');

        Schema::table('expected_spendings', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('expected_spendings');
            $table->integer('year');
            $table->string('month');
        });
    }
};
