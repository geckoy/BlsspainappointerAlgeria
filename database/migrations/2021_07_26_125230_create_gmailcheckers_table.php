<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGmailcheckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gmailcheckers', function (Blueprint $table) {
            $table->id();
            $table->text("gmail");
            $table->text("password");
            $table->text("password_bls");
            $table->text("referer")->nullable();
            $table->text("timeout")->nullable();
            $table->string('PHPSESSID')->nullable();
            $table->string('AWSALBCORS')->nullable();
            $table->string('AWSALB')->nullable();
            $table->boolean("isLogged")->default(false);
            $table->boolean("isBad")->default(false);
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
        Schema::dropIfExists('gmailcheckers');
    }
}
