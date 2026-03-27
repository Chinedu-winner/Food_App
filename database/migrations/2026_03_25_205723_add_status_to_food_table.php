<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(){
    Schema::table('food', function (Blueprint $table) {
        $table->string('status')->default('available');
    });
}

    public function down(): void{
        Schema::table('food', function (Blueprint $table) {
            //
        });
    }
};
