<?php declare(strict_types=1);

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

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('scraped_product_id')->constrained('ScrapedProducts');
            $table->foreignUuid('user_id')->nullable()->constrained('Users');
            $table->string('reviewer_name');
            $table->text('content');
            $table->json('photo_path')->nullable();
            $table->float('stars')->default('0');
            $table->integer('helpful_votes')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
