<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 10, 2)->index();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['category_id','name']); // sensible uniqueness inside a category
        });
    }
    public function down(): void {
        Schema::dropIfExists('items');
    }
};
