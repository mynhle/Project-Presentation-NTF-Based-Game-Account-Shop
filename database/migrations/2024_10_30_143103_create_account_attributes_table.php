<?php

use App\Models\Account;
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
        Schema::create('account_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)->constrained(); 
            $table->string('attribute_name');  // Tên thuộc tính (ví dụ: level, power, items)
            $table->string('attribute_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_attributes');
    }
};