<?php

use App\Http\Enums\LoanTypeEnum;
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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array_map(static fn(LoanTypeEnum $type) => $type->value, LoanTypeEnum::cases()));
            $table->foreignId('adviser_id')->index()->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->index()->constrained('clients')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('home_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->index()->constrained('loans')->cascadeOnDelete();
            $table->decimal('property_value');
            $table->decimal('down_payment_amount');
            $table->timestamps();
        });

        Schema::create('cash_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->index()->constrained('loans')->cascadeOnDelete();
            $table->decimal('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_loans');
        Schema::dropIfExists('home_loans');
        Schema::dropIfExists('loans');
    }
};
