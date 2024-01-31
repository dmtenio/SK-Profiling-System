<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();

            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->bigInteger('purok_id');
            $table->enum('gender', ['male', 'female']);
            $table->integer('age')->nullable();
            $table->date('dob');
            $table->string('civil_status');
            $table->string('email')->nullable();
            $table->string('mobile_num')->nullable();
            $table->string('youth_group')->nullable();
            $table->string('educational_background');
            $table->string('youth_classification');
            $table->string('youth_specific_needs')->nullable();
            $table->string('work_status');
            $table->enum('sk_voter', ['yes', 'no']);
            $table->enum('voted_last_sk', ['yes', 'no']);
            $table->enum('national_voter', ['yes', 'no']);
            $table->enum('attended_assembly', ['yes', 'no']);
            $table->string('attended_yes_how_many')->nullable();
            $table->string('attended_no_why')->nullable();
            $table->boolean('is_youth')->default(true);
            $table->boolean('is_living')->default(true);
            $table->string('avatar')->nullable();
            $table->date('date_interviewed')->nullable();
            $table->bigInteger('encoded_by');

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
        Schema::dropIfExists('residents');
    }
};
