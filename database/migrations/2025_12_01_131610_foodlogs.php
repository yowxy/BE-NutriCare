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
        Schema::create('food_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('food_name');
            $table->integer('calories')->default(0);
            $table->float('protein')->default(0);
            $table->float('carbs')->default(0);
            $table->float('fat')->default(0);
            $table->float('sugar')->default(0);
            $table->float('sodium')->default(0);
            $table->float('vit_c')->default(0);
            $table->float('vit_a')->default(0);
            $table->float('potassium')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_logs');
    }
};
