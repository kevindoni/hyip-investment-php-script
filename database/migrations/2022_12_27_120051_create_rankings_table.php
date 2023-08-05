<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->string('rank_name')->nullable();
            $table->string('rank_lavel')->nullable();
            $table->decimal('min_invest')->default(0);
            $table->decimal('min_deposit')->default(0);
            $table->decimal('min_earning')->default(0);
            $table->string('description')->nullable();
            $table->text('rank_icon')->nullable();
            $table->integer('sort_by')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('rankings');
    }
}
