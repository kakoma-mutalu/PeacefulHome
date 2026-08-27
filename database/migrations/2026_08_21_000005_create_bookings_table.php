<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function(Blueprint $table){
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('patient_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->constrained()->restrictOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone',30);
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->decimal('amount',12,2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['booking_date','booking_time']);
        });
    }
    public function down(): void { Schema::dropIfExists('bookings'); }
};
