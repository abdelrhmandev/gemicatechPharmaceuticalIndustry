<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePageBlockTable extends Migration
{
    public function up(){
        Schema::create('page_block', function (Blueprint $table) {
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade');
            $table->unique(['page_id','block_id']);
        });
    }
    public function down(){
        Schema::dropIfExists('page_block');
    }
}
