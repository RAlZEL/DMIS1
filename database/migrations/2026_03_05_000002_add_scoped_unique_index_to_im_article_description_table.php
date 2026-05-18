<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'im_article_description';
    private string $articleIdIndexName = 'im_article_description_article_id_index';
    private string $scopedUniqueIndexName = 'im_article_description_article_id_article_description_unique';

    public function up(): void
    {
        if (! Schema::hasTable($this->tableName)) {
            return;
        }

        if (! Schema::hasColumn($this->tableName, 'article_id') || ! Schema::hasColumn($this->tableName, 'article_description')) {
            return;
        }

        $duplicateCount = DB::table($this->tableName)
            ->select('article_id', 'article_description', DB::raw('COUNT(*) as duplicate_count'))
            ->groupBy('article_id', 'article_description')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        if ($duplicateCount > 0) {
            throw new RuntimeException(
                "Cannot add unique index to {$this->tableName}: found {$duplicateCount} duplicate (article_id, article_description) records."
            );
        }

        $hasArticleIdIndex = $this->hasIndex($this->articleIdIndexName);
        $hasScopedUniqueIndex = $this->hasIndex($this->scopedUniqueIndexName);

        Schema::table($this->tableName, function (Blueprint $table) use ($hasArticleIdIndex, $hasScopedUniqueIndex) {
            if (! $hasArticleIdIndex) {
                $table->index('article_id', $this->articleIdIndexName);
            }

            if (! $hasScopedUniqueIndex) {
                $table->unique(['article_id', 'article_description'], $this->scopedUniqueIndexName);
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable($this->tableName)) {
            return;
        }

        $hasScopedUniqueIndex = $this->hasIndex($this->scopedUniqueIndexName);
        $hasArticleIdIndex = $this->hasIndex($this->articleIdIndexName);

        Schema::table($this->tableName, function (Blueprint $table) use ($hasScopedUniqueIndex, $hasArticleIdIndex) {
            if ($hasScopedUniqueIndex) {
                $table->dropUnique($this->scopedUniqueIndexName);
            }

            if ($hasArticleIdIndex) {
                $table->dropIndex($this->articleIdIndexName);
            }
        });
    }

    private function hasIndex(string $indexName): bool
    {
        if (DB::getDriverName() !== 'mysql') {
            return false;
        }

        return ! empty(DB::select(
            "SHOW INDEX FROM `{$this->tableName}` WHERE Key_name = ?",
            [$indexName]
        ));
    }
};

