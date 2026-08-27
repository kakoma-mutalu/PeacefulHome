<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('appointments', function(Blueprint $table){
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->restrictOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('appointment_at');
            $table->string('status')->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['appointment_at','status']);
        });
    }
    public function down(): void { Schema::dropIfExists('appointments'); }
};
