<?php

use App\Models\Game;
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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Game::class)->constrained(); 
            $table->string('sku')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('image')->nullable();  
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'sold', 'pending'])->default('available'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
