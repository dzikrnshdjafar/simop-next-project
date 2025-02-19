<?php

use App\Constants\ActivityStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name', 64);
            $table->string('status', 16)->default(ActivityStatus::PENDING);
            $table->string('place', 64);
            $table->date('date');
            $table->string('attachment');
            $table->foreignId('pic_id')->constrained('pics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
