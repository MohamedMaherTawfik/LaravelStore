<?php

use App\Models\brands;
use App\Models\categories;
use App\Models\marketPlace;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->decimal('price',8,2);
            $table->string('discount')->nullable();
            $table->integer('quantity');
            $table->enum('is_available',['available','not_available'])->default('available');
            $table->foreignIdFor(categories::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(brands::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(marketPlace::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
