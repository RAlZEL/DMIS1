<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('im_article_name')) {
            return;
        }

        Schema::table('im_article_name', function (Blueprint $table) {
            if (! Schema::hasColumn('im_article_name', 'ppe_uacs')) {
                $table->string('ppe_uacs')->nullable()->after('article_name');
            }

            if (! Schema::hasColumn('im_article_name', 'semi_ex_uacs')) {
                $table->string('semi_ex_uacs')->nullable()->after('ppe_uacs');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('im_article_name')) {
            return;
        }

        Schema::table('im_article_name', function (Blueprint $table) {
            if (Schema::hasColumn('im_article_name', 'semi_ex_uacs')) {
                $table->dropColumn('semi_ex_uacs');
            }

            if (Schema::hasColumn('im_article_name', 'ppe_uacs')) {
                $table->dropColumn('ppe_uacs');
            }
        });
    }
};