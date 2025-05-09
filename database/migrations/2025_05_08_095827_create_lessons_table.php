<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('season_id')->nullable()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug');
            $table->boolean('free')->default(false);
            $table->longText('body')->nullable();
            $table->tinyInteger('time')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->nullable();
            $table->enum('confirmation_status', \Fateme\Course\Models\Lesson::$confirmationStatuses)
                ->default(\Fateme\Course\Models\Season::CONFIRMATION_STATUS_PENDING);
            $table->enum('status', \Fateme\Course\Models\Lesson::$statuses)
                ->default(\Fateme\Course\Models\Season::STATUS_OPENED);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
