<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateProductIndustryTable extends Migration
{
    public function up(){
        Schema::create('product_industry', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('industry_id')->constrained('industries')->onDelete('cascade');
            $table->unique(['product_id','industry_id']);
        });
    }
    public function down(){
        Schema::dropIfExists('product_industry');
    }
}
