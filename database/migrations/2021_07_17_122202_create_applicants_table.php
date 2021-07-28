<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->text('applicants');
            $table->string('gmail');
            $table->string('passportnum');
            $table->string('phonenum');
            $table->string('type');
            $table->string('password');
            $table->string("password_bls");
            $table->string('members_count');
            $table->string('passportex');
            $table->string('passportsub');
            $table->string('passportplace');
            $table->string('center')->nullable();
            $table->string('PHPSESSID')->nullable();
            $table->string('AWSALBCORS')->nullable();
            $table->string('AWSALB')->nullable();
            $table->boolean('isPorcessing')->default(false);
            $table->boolean('isMailrequested')->default(false);
            $table->boolean('isMailprocessing')->default(false);
            $table->boolean('isAppointed')->default(false);
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
        Schema::dropIfExists('applicants');
    }
}
