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

        Schema::create('product_concept_stats_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('product_concept_id')->constrained('ProductConcepts');
            $table->timestamp('timestamp');
            $table->float('average_sales')->default('0');
            $table->float('stdev_sales')->default('0');
            $table->integer('publications_number')->default(0);
            $table->float('ali_to_meli_rate')->default('0');
            $table->float('growth_rate')->default('0');
            $table->float('price_trend')->default('0');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_concept_stats_histories');
    }
};
