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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('nominal');
            $table->string('year')->nullable();
            $table->string('letter')->nullable();
            $table->string('metal')->nullable();
            $table->foreignId('save_id')->constrained('im_lot_saves');
            $table->foreignId('metal_id')->constrained('im_lot_metals');
            $table->decimal('price', 8, 2, true)->default(0);
            $table->dateTime('closing_at')->default(now());
            $table->foreignId('auction_id')->constrained('im_auctions');
            $table->foreignId('category_id')->constrained('im_categories');
            $table->increments('position');
            $table->string('rarity')->nullable();
            $table->string('owner')->nullable();
            $table->string('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
