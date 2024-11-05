j<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetupBannersModule extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    // This table should store the banners catalog for different
    // Sections in the web page
    // Program your banner schedule for different seasons of the year
    // Or specific times (let's say a promo)
    Schema::create('banners', function (Blueprint $table) {
      $table->id();
      $table->string('section');
      $table->string('slug');
      $table->boolean('is_published')->default(true);
      $table->date('date_from');
      $table->date('date_to');
      $table->timestamps();
      $table->softDeletes();
    });
    
    // This table should store all the photo gallery for the banner above
    // You shall program your photo schedule
    // For different date ranges in the season banner
    // like months with many holy days or patriotic stuff
    Schema::create('photos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('banner_id');
      $table->string('small_image');
      $table->string('cover_image');
      $table->string('title')->nullable();
      $table->string('body')->nullable();
      $table->string('caption')->nullable();
      $table->string('link')->nullable();
      $table->boolean('is_published')->default(true);
      $table->date('date_from');
      $table->date('date_to');
      $table->timestamps();
      $table->softDeletes();
      $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
    });
  }
  
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropDatabaseIfExists("banners");
    Schema::dropDatabaseIfExists("photos");
  }
}
