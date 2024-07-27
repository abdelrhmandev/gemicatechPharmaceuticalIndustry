<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateProductCategoryTable extends Migration
{
    public function up(){
        Schema::create('product_category', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->unique(['product_id','category_id']);
        });
    }
    public function down(){
        Schema::dropIfExists('product_category');
    }
}
