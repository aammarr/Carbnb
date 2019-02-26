<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateTableCars extends Migration
{
    use SoftDeletes;
    protected $table = 'cars';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('car_title')->nullable();
            $table->string('car_make')->nullable();
            $table->string('car_model')->nullable();
            $table->integer('car_year')->nullable();
            $table->string('car_color')->nullable();
            $table->string('car_engine_type')->nullable();
            $table->string('car_transmission')->nullable();
            $table->string('car_chasisNumber')->nullable();
            $table->string('car_engineNumber')->nullable();
            $table->string('car_ratePerDay')->nullable();
            $table->string('car_ratePerHour')->nullable();
            $table->integer('bluetooth')->nullable();
            $table->integer('childseat')->nullable();
            $table->integer('gps')->nullable();
            $table->integer('four_wheel')->nullable();
            $table->integer('ac')->nullable();
            $table->integer('delivery_onSite')->nullable();
            $table->integer('withDriver')->nullable();
            $table->double('rental_deposit')->nullable();
            $table->string('car_paper')->nullable();
            $table->string('car_address')->nullable();
            $table->double('car_lat')->default(0);
            $table->double('car_long')->default(0);
            $table->datetime('available_from')->nullable();
            $table->datetime('available_to')->nullable();
            $table->string('car_payment_method')->nullable();
            $table->string('car_avatar_1')->nullable();
            $table->string('car_avatar_2')->nullable();
            $table->string('car_avatar_3')->nullable();
            $table->string('car_avatar_4')->nullable();
            $table->string('car_avatar_5')->nullable();
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
        //
    }
}
