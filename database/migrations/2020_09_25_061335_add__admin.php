<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin = [
            'name' => 'Jone Doue',
            'email' => 'jone@email.com',
            'password' => \Illuminate\Support\Facades\Hash::make(123456),
            'phone'     =>123456789,
            'email_verified_at' => null,
        ];
        \App\Models\Admin::create($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
