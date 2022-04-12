<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sentbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentbox', function (Blueprint $table) {
            $table->id();
            $table->integer('sent_by');
            $table->text('to_emails');
            $table->text('cc_emails')->nullable();
            $table->text('bcc_emails')->nullable();
            $table->text('from_emails');
            $table->mediumText('subject');
            $table->longText('body');
            $table->text('attachments');
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
        Schema::dropIfExists('sentbox');
    }
    
}
