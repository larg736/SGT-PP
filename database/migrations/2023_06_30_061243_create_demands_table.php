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
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('description');            
            $table->string('severity', 1);

            $table->boolean('active')->default(1);

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->integer('level_id')->unsigned()->nullable();
            $table->foreign('level_id')->references('id')->on('levels');

            $table->foreignId('client_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('clerk_id')->nullable()->constrained('users')->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
