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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('fname', 64);
            $table->string('lname', 64);
            $table->text('addressline', 64);
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('img_path')->default('employee.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

         Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('img_path')->default('customer.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pet_breed', function (Blueprint $table) {
            $table->increments('petb_id');
            $table->string('pbreed', 64);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('pet_id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->integer('petb_id')->unsigned();
            $table->foreign('petb_id')->references('petb_id')->on('pet_breed');
            $table->string('pname', 64);
            $table->string('gender');
            $table->integer('age');
            $table->text('img_path')->default('pet.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    
    
    Schema::create('grooming_service', function (Blueprint $table) {
            $table->increments('service_id');
            $table->string('service_name', 64);
            $table->decimal('service_cost');
            $table->text('img_path')->default('service.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

    Schema::create('disease_injuries', function (Blueprint $table) {
            $table->increments('disease_id');
            $table->string('disease_name', 64);
            $table->timestamps();
            $table->softDeletes();
        });
    Schema::create('comment_reviews', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->text('name');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('service_id')->on('grooming_service');
            $table->text('comment');
            $table->timestamps();
        });

    Schema::create('grooming_info', function (Blueprint $table) {
            $table->increments('groominginfo_id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('pet_id')->on('pets');
            $table->timestamps();
            $table->softDeletes();
        });

    Schema::create('groomingline', function ($table) {
            $table->integer('groominginfo_id')->unsigned();
            $table->foreign('groominginfo_id')->references('groominginfo_id')->on('grooming_info');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('service_id')->on('grooming_service');
         });

    Schema::create('health_consultation', function (Blueprint $table) {
            $table->increments('consult_id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('pet_id')->on('pets');
            $table->integer('disease_id')->unsigned();
            $table->foreign('disease_id')->references('disease_id')->on('disease_injuries');
            $table->integer('emp_id')->unsigned();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->text('observation');
            $table->double('consult_cost');
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
         Schema::dropIfExists('customers');
         Schema::dropIfExists('pets');
         Schema::dropIfExists('employees');
         Schema::dropIfExists('grooming_service');
         Schema::dropIfExists('pet_breed');
         Schema::dropIfExists('disease_injuries');
         Schema::dropIfExists('grooming_info');
         Schema::dropIfExists('groomingline');
         Schema::dropIfExists('health_consultation');
    }
};
