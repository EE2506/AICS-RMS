<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtpFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp', 6)->nullable(); // Add OTP column
            $table->timestamp('otp_expires_at')->nullable(); // Add OTP expiration timestamp
            $table->timestamp('otp_verified_at')->nullable(); // Add OTP verified timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['otp', 'otp_expires_at', 'otp_verified_at']); // Drop columns if rolling back
        });
    }
}
