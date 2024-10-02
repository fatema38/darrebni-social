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
        Schema::create('user_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // عمود معرّف المستخدم مع تفعيل القيود
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade'); // عمود معرّف المجموعة مع تفعيل القيود
            $table->boolean('is_admin')->default(false); // عمود لتحديد ما إذا كان المستخدم مسؤولاً
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_group');
    }
};
