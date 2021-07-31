<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPokemonTypeApiIdToTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->integer('pokemon_type_api_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('pokemon_type_api_id');
        });
    }
}
