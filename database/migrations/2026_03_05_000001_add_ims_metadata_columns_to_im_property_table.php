<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('im_property')) {
            return;
        }

        Schema::table('im_property', function (Blueprint $table) {
            if (! Schema::hasColumn('im_property', 'uacs')) {
                $table->string('uacs')->nullable();
            }

            if (! Schema::hasColumn('im_property', 'fund_cluster')) {
                $table->string('fund_cluster')->nullable();
            }

            if (! Schema::hasColumn('im_property', 'estimated_useful_life')) {
                $table->string('estimated_useful_life')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('im_property')) {
            return;
        }

        Schema::table('im_property', function (Blueprint $table) {
            if (Schema::hasColumn('im_property', 'uacs')) {
                $table->dropColumn('uacs');
            }

            if (Schema::hasColumn('im_property', 'fund_cluster')) {
                $table->dropColumn('fund_cluster');
            }

            if (Schema::hasColumn('im_property', 'estimated_useful_life')) {
                $table->dropColumn('estimated_useful_life');
            }
        });
    }
};
