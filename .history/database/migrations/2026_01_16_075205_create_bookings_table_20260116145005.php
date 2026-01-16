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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->integer('phone_number');
            $table->string('status')->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }
curl -X POST http://127.0.0.1:8000/mcp/booking \
  -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}'

curl -X POST http://127.0.0.1:8000/mcp/booking \
-H "Content-Type: application/json" \
-d '{"jsonrpc":"2.0","id":99,"method":"tools/list","params":{}}'


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
