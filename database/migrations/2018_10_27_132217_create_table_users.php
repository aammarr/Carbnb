<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateTableUsers extends Migration
{
    use SoftDeletes;
    protected $table = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->string('email',50)->unique();
            $table->string('password')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('city_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('nic_number')->nullable();
            $table->string('nic_avatar')->nullable();
            $table->string('nic_isVerified')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_avatar')->nullable();
            $table->string('license_isVerified')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->double('lat')->default(0);
            $table->double('long')->default(0);
            $table->double('rating')->default(0);
            $table->integer('reviewCount')->default(0);
            $table->integer('otp')->nullable();
            $table->integer('isVerified')->nullable();
            $table->string('device')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('notification')->default(true);
            $table->string('social_login')->nullable();
            $table->string('social_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
