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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string("slug");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("city_id")->constrained()->cascadeOnDelete();
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->string("title");
            $table->string("type"); //TypeEnum:class
            $table->unsignedInteger("floor")->default(0);
            $table->unsignedBigInteger("meterage");
            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("mortgage_price")->nullable();
            $table->unsignedBigInteger("rent_price")->nullable();
            $table->unsignedInteger("room_count");
            $table->unsignedInteger("toilet_count");
            $table->boolean("has_parking")->default(false);
            $table->boolean("has_elevator")->default(false);
            $table->boolean("has_warehouse")->default(false);
            $table->schemalessAttributes("extra_attributes");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
