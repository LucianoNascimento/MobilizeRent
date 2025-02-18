<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable();
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('token')->nullable();
            $table->string('refreshToken')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'nickname',
                'avatar',
                'token',
                'refreshToken'
            ]);
        });
    }
};
