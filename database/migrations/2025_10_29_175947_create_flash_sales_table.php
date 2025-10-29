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
        Schema::create('flash_sales', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained()->cascadeOnDelete();

            $t->dateTime('starts_at')->index();
            $t->dateTime('ends_at')->index();

            $t->unsignedSmallInteger('limit_per_user')->default(1);
            $t->timestamps(); // created_at / updated_at (يمكن إبقاؤها timestamp أو استخدام timestampsTz)
            $t->index(['product_id','starts_at','ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_sales');
    }
};
