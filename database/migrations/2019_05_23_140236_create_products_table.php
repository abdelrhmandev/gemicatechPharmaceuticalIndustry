<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductsTable extends Migration
{
    public function up(){
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->Text('brief')->default(NULL)->nullable();
            $table->longText('description')->default(NULL)->nullable();
            $table->string('image',150)->default(NULL)->nullable();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
       });
     }
    public function down(){
        Schema::dropIfExists('products');
    }
}
