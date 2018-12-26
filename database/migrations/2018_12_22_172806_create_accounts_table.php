<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->double('balance')->default(0.00);
            $table->integer('interest_rate_id')->unsigned()->default(1);

            $table->foreign('interest_rate_id')
                ->references('id')
                ->on('interest_rates');

            $table->timestamp('accrual_date')->nullable();
            $table->timestamps();
        });

        Schema::create('account_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('account_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_user');
        Schema::dropIfExists('accounts');
    }
}
