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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->foreignId('conference_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('name');
            $table->string('email')->nullable();
            $table->char('gender');
            $table->string('residence')->nullable();
            $table->string('room')->nullable();
            $table->boolean('paid')->default(0);
            $table->double('amount', 8, 2)->default(0.00);

            $table->string('active_contact')->nullable();
            $table->string('other_contact')->nullable();
            $table->timestamps();

            // $table->unique(['conference_id', 'email']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
