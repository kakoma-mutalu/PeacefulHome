<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('duration_label')->nullable()->after('duration_minutes');
            $table->string('audience')->nullable()->after('description');
            $table->text('involves')->nullable()->after('audience');
            $table->text('benefits')->nullable()->after('involves');
            $table->text('includes')->nullable()->after('benefits');
            $table->boolean('is_programme')->default(false)->after('is_active');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_reference')->nullable()->unique()->after('reference');
            $table->string('provider')->nullable()->after('payment_reference');
            $table->string('provider_transaction_id')->nullable()->after('provider');
            $table->string('currency', 3)->default('ZMW')->after('amount');
            $table->string('phone_number', 30)->nullable()->after('currency');
            $table->timestamp('initiated_at')->nullable()->after('status');
            $table->timestamp('completed_at')->nullable()->after('initiated_at');
            $table->string('failure_reason')->nullable()->after('completed_at');
            $table->json('provider_response')->nullable()->after('failure_reason');
        });
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); $table->string('phone', 30); $table->string('email')->nullable();
            $table->string('subject'); $table->text('message'); $table->string('status')->default('new');
            $table->timestamps();
        });
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->string('relationship')->nullable();
            $table->text('quote'); $table->boolean('is_placeholder')->default(true); $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('testimonials'); Schema::dropIfExists('enquiries');
        Schema::table('payments', function (Blueprint $table) { $table->dropColumn(['payment_reference','provider','provider_transaction_id','currency','phone_number','initiated_at','completed_at','failure_reason','provider_response']); });
        Schema::table('services', function (Blueprint $table) { $table->dropColumn(['duration_label','audience','involves','benefits','includes','is_programme']); });
    }
};
