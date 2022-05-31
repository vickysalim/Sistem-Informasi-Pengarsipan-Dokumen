<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_id');
            $table->foreign('archive_id')->references('id')->on('archives');
            $table->foreignId('archive_form_id');
            $table->foreign('archive_form_id')->references('id')->on('archive_category_forms');
            $table->string('description', 1023);
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
        Schema::dropIfExists('archive_descriptions');
    }
}
