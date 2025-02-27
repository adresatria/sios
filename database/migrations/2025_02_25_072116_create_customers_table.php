<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name_organization');
            $table->string('type_organization');
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('npwp_number')->nullable();
            $table->string('npwp_file')->nullable(); // Untuk menyimpan path file NPWP
            $table->string('phone_number');
            $table->string('email_organization');
            $table->string('name_pic');
            $table->string('pic_phone_number');
            $table->string('pic_email');
            $table->string('position');
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
