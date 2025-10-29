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
        Schema::create('payments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('order_id')->constrained()->cascadeOnDelete();
            $t->string('provider', 40);                // stripe/paypal/mock
            $t->unsignedInteger('amount_cents');
            $t->char('currency', 3)->default('USD');
            $t->enum('status', ['pending','success','failed'])->index();
            $t->string('external_id', 191)->nullable()->index();
            $t->json('meta')->nullable();
            $t->timestamps();

            $t->unique('order_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
