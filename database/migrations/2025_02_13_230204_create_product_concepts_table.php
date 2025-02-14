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

        Schema::create('product_concepts', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('product_concept_stats_id')->constrained('ProductConceptStats');
            $table->foreignUuid('user_id')->constrained('Users');
            $table->foreignUuid('category_id')->constrained('Categories');
            $table->string('name');
            $table->text('description');
            $table->text('concept_reviews_conclusion');
            $table->boolean('manual_review_flag')->default(false);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_concepts');
    }
};
