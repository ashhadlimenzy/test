<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_login_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->index()->default(0);
            $table->tinyInteger('status')->nullable()->comment('0:Failed; 1:Success, 2:Logout, 3:Lockout');
            $table->timestamp('logged_at')->nullable();
            $table->string('remote_address')->nullable();
            $table->text('note')->nullable();
            $table->text('header')->nullable();
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
        Schema::dropIfExists('doctor_login_logs');
    }
}
