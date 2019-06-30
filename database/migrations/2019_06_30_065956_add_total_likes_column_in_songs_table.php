<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalLikesColumnInSongsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('songs', function (Blueprint $table) {
            $table->bigInteger('total_likes')->after('genre')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('total_likes');
        });
    }

}
