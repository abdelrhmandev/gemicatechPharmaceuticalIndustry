<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateProductMediaTable extends Migration
{
    public function up(){
        Schema::create('product_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('assigned_for',150);
            $table->string('file',150);
        });
    }
    public function down(){
        Schema::dropIfExists('product_media');
    }
}
