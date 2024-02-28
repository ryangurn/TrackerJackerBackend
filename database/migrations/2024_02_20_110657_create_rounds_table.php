<?php

use App\Models\Competition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(Competition::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('number');
            $table->string('level')
                ->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('active_override')
                ->default(false);
            $table->timestamps();
            
            $table->unique(['competition_id', 'number', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
