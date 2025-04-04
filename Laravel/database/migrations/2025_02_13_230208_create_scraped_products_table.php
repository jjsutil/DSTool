<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('scraped_products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('source_id')->constrained('Sources');
            $table->foreignUuid('product_concept_id')->constrained('ProductConcepts');
            $table->foreignUuid('provider_id')->constrained('Providers');
            $table->string('name');
            $table->foreignUuid('category_id')->constrained('Categories');
            $table->integer('sales_quantity')->default(0);
            $table->float('price')->default('0');
            $table->string('currency')->default('USD');
            $table->text('review_conclusion')->nullable();
            $table->float('stars')->nullable()->default('0');
            $table->json('photo_path')->nullable();
            $table->integer('reviews_count')->default(0);
            $table->integer('stock_quantity')->default(0);
            $table->date('shipping_date')->nullable();
            $table->float('shipping_cost')->nullable()->default('0');
            $table->string('shipping_currency')->default('USD');
            $table->float('matching_confidence_score')->nullable()->default('0');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraped_products');
    }
};
