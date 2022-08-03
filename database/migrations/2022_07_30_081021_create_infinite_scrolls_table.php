<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfiniteScrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infinite_scrolls', function (Blueprint $table) {
            $table->id();
            $table->boolean('enabled');
            $table->string('shop_id')->unique();
            $table->string('theme_id', 100);
            $table->char('delay', 10);
            $table->string('container', 100);
            $table->string('itemLoad', 100);
            $table->string('pagination', 100);
            $table->string('nextPagination', 100);
            $table->string('loadingText', 255);
            $table->string('image')->nullable();
            $table->string('doneText', 100);
            $table->string('loadMoreButtonText', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infinite_scrolls');
    }
}
