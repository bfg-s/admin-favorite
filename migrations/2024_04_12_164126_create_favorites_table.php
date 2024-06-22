<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            /** @var \Illuminate\Database\Eloquent\Model $userModel */
            $userModel = new (config('auth.providers.users.model'));
            $table->foreignId(\Illuminate\Support\Str::singular($userModel->getTable()) . '_id')
                ->nullable()
                ->constrained($userModel->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->morphs('favoritable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
