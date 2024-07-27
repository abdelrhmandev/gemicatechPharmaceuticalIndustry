<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCategoriesTable extends Migration
{
    public function up(){
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->default(NULL)->nullable();
            $table->string('color',10)->default(NULL)->nullable();
            $table->string('icon')->default(NULL)->nullable();
            $table->unsignedBigInteger('parent_id')->default(NULL)->nullable();
			$table->string('image',150)->default(NULL)->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }
    public function down(){
        Schema::dropIfExists('categories');
    }
}
