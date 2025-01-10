<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('client_name');
            $table->string('architect_name');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->string('featured');

            //
            $table->text('image');
            $table->string('project_type');
            $table->string('budget');
            $table->string('completion');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
