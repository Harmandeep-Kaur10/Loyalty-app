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
        Schema::create('activity_logs', function (Blueprint $table) {
		$table->id();
		$table->bigInteger("shop_id")->default(0);
		$table->string("msd")->default(0);
		$table->bigInteger("customer_id")->default(0);
		$table->string("activity_type")->default(0);
		$table->string("points_changed")->default(0);
		$table->text("activity_data");
		$table->integer("current_points")->default(0);
            	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
