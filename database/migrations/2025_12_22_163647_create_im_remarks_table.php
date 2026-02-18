<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('im_remarks', function (Blueprint $table) {
            $table->id();
            $table->string('remark_name', 100)->unique();
            $table->timestamps();
        });

        // Insert default remarks
        \Illuminate\Support\Facades\DB::table('im_remarks')->insert([
            ['remark_name' => 'IN GOOD CONDITION'],
            ['remark_name' => 'FOR SURRENDER'],
            ['remark_name' => 'FOR DISPOSAL'],
            ['remark_name' => 'DISPOSED'],
            ['remark_name' => 'UNSERVICEABLE'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('im_remarks');
    }
}
