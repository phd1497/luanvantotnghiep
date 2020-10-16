<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category_product', function (Blueprint $table) {
            $table->Increments('category_id');//increament là dặng tự tăng và là khóa chính
            $table->string('category_name');
            $table->text('category_desc');
            $table->integer('category_status');
            $table->timestamps();// timestamp là lấy ngày hiện tại (b12)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_category_product');
    }
}
