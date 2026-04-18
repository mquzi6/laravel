<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название мебели
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('category')->nullable(); // категория: столы, стулья, шкафы и т.д.
            $table->string('material')->nullable(); // материал: дерево, металл, стекло
            $table->string('color')->nullable(); // цвет
            $table->string('dimensions')->nullable(); // размеры
            $table->float('rating')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}