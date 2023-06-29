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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("shirt_length")->nullable();
            $table->string("around_arm")->nullable();
            $table->string("waist")->nullable();
            $table->string("neck")->nullable();
            $table->string("trouser_length")->nullable();
            $table->string("shoulder_to_chest")->nullable();
            $table->string("hip")->nullable();
            $table->string("shoulder_to_hip")->nullable();
            $table->string("breast_length")->nullable();
            $table->string("shoulder_to_waist")->nullable();
            $table->string("ankle")->nullable();
            $table->string("dress_length")->nullable();
            $table->string("notes")->nullable();
            $table->enum("status", ["pending", "started", "done"])->default("pending");
            $table->foreignId("customer_id")->constrained("customers")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
