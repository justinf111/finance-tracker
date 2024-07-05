<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('starting_balance', 'balance');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->decimal('balance', 10, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('balance', 'starting_balance');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('starting_balance')->change();
        });
    }
};
