<?php

use App\Models\User;
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
        Schema::create('user_images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index();
            $table->string('image')->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_images');
    }
};
