<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
	public function up()
	{
		Schema::create('shops', function (Blueprint $table) {
			$table->id();
			$table->bigInteger("shop_id")->default(0);
			$table->string("name")->default(0);
			$table->string("msd")->default(0);
			$table->string("our_passw_token")->default(0);
			$table->string("state")->default(0);
			$table->string("customization")->default('[]');
			$table->string("currency_format")->default(0);
			$table->integer("theme_extension_status")->default(0);
			$table->text("activities");
			$table->text("rewards");
			$table->string("owner_name")->default(0);
			$table->string("owner_email")->default(0);
			$table->string("timezone")->default(0);
			$table->string("iana_timezone")->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('shops');
	}
}
