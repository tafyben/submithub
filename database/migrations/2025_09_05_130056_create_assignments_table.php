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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            // Student who requests the assignment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Admin who prepares/completes the assignment (nullable)
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            // Optional files
            $table->string('request_file_path')->nullable();
            $table->string('response_file_path')->nullable();
            // Assignment status
            $table->enum('status', ['pending', 'submitted', 'completed'])->default('pending');

            // When admin submits
            $table->timestamp('submitted_at')->nullable();

            // Feedback from admin
            $table->text('feedback')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
