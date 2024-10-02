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

                Schema::create('posts', function (Blueprint $table) {
                    $table->id(); // معرّف فريد للمنشور
                    $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // معرّف المستخدم مع تفعيل القيد
                    $table->foreignId('group_id')->nullable();
                    $table->boolean('pendingPost')->default(true);
                    $table->string('title'); // عنوان المنشور
                    $table->text('content'); // محتوى المنشور، تم استخدام text للمرونة مع طول المحتوى
                    $table->json('tags')->nullable(); // الوسوم بصيغة JSON
                    $table->timestamps(); // أعمدة التوقيتات
                });


        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
