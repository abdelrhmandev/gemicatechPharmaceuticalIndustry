<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSlidersTable extends Migration {
	public function up() {
		Schema::create('sliders', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->longText('description')->default(NULL)->nullable();
            $table->string('image',150)->default(NULL)->nullable();
            $table->string('link')->default(NULL)->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			});
	}
	public function down() {
		Schema::dropIfExists('sliders');
	}
}
