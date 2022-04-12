<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UtmData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utm_data', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id');
            $table->string('table_name');
            $table->string('utm_source');
            $table->string('utm_medium');
            $table->string('utm_campaign');
            $table->string('utm_term');
            $table->string('utm_content');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utm_data');
    }
}
