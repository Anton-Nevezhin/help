<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // добавляем нужные поля
            $table->string('phone')->nullable()->unique()->after('email');
            $table->string('telegram_id')->nullable()->after('phone');
            $table->string('whatsapp_phone')->nullable()->after('telegram_id');
            $table->string('vk_id')->nullable()->after('whatsapp_phone');
            $table->enum('role', ['user', 'admin'])->default('user')->after('vk_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'telegram_id', 'whatsapp_phone', 'vk_id', 'role']);
        });
    }
};