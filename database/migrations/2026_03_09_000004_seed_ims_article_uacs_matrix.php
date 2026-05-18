<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('fm_uacs') || ! Schema::hasTable('im_article_name')) {
            return;
        }

        if (! Schema::hasColumn('im_article_name', 'ppe_uacs') || ! Schema::hasColumn('im_article_name', 'semi_ex_uacs')) {
            return;
        }

        $now = now();

        foreach ($this->standardUacsCodes() as $uacsCode) {
            $exists = DB::table('fm_uacs')->where('uacs', $uacsCode)->exists();
            if (! $exists) {
                DB::table('fm_uacs')->insert([
                    'uacs' => $uacsCode,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        foreach ($this->standardMatrix() as $row) {
            $exists = DB::table('im_article_name')->where('article_name', $row['article_name'])->exists();

            $payload = [
                'ppe_uacs' => $row['ppe_uacs'],
                'semi_ex_uacs' => $row['semi_ex_uacs'],
                'updated_at' => $now,
            ];

            if ($exists) {
                DB::table('im_article_name')
                    ->where('article_name', $row['article_name'])
                    ->update($payload);
                continue;
            }

            DB::table('im_article_name')->insert([
                'article_name' => $row['article_name'],
                'ppe_uacs' => $row['ppe_uacs'],
                'semi_ex_uacs' => $row['semi_ex_uacs'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('fm_uacs') || ! Schema::hasTable('im_article_name')) {
            return;
        }

        if (Schema::hasColumn('im_article_name', 'ppe_uacs') && Schema::hasColumn('im_article_name', 'semi_ex_uacs')) {
            $now = now();

            foreach ($this->standardMatrix() as $row) {
                $query = DB::table('im_article_name')
                    ->where('article_name', $row['article_name'])
                    ->where('ppe_uacs', $row['ppe_uacs']);

                if ($row['semi_ex_uacs'] === null) {
                    $query->whereNull('semi_ex_uacs');
                } else {
                    $query->where('semi_ex_uacs', $row['semi_ex_uacs']);
                }

                $query->update([
                    'ppe_uacs' => null,
                    'semi_ex_uacs' => null,
                    'updated_at' => $now,
                ]);
            }
        }

        if (! Schema::hasTable('fm_uacs')) {
            return;
        }

        foreach ($this->standardUacsCodes() as $uacsCode) {
            $usedByProperty = Schema::hasTable('im_property')
                ? DB::table('im_property')->where('uacs', $uacsCode)->exists()
                : false;

            $usedByArticle = DB::table('im_article_name')
                ->where('ppe_uacs', $uacsCode)
                ->orWhere('semi_ex_uacs', $uacsCode)
                ->exists();

            if (! $usedByProperty && ! $usedByArticle) {
                DB::table('fm_uacs')->where('uacs', $uacsCode)->delete();
            }
        }
    }

    private function standardUacsCodes(): array
    {
        $codes = [];

        foreach ($this->standardMatrix() as $row) {
            if ($row['ppe_uacs']) {
                $codes[] = $row['ppe_uacs'];
            }

            if ($row['semi_ex_uacs']) {
                $codes[] = $row['semi_ex_uacs'];
            }
        }

        return array_values(array_unique($codes));
    }

    private function standardMatrix(): array
    {
        return [
            ['article_name' => 'BUILDINGS', 'ppe_uacs' => '10604010', 'semi_ex_uacs' => null],
            ['article_name' => 'COMMUNICATION EQUIPMENT', 'ppe_uacs' => '10605070', 'semi_ex_uacs' => '10405070'],
            ['article_name' => 'FURNITURE AND FIXTURE', 'ppe_uacs' => '10607010', 'semi_ex_uacs' => '10406010'],
            ['article_name' => 'ICT EQUIPMENT', 'ppe_uacs' => '10605030', 'semi_ex_uacs' => '10405030'],
            ['article_name' => 'LAND', 'ppe_uacs' => '10601010', 'semi_ex_uacs' => null],
            ['article_name' => 'LAND IMPROVEMENTS, REFORESTATION PROJECTS', 'ppe_uacs' => '10602020', 'semi_ex_uacs' => null],
            ['article_name' => 'MACHINERY', 'ppe_uacs' => '10605010', 'semi_ex_uacs' => '10405010'],
            ['article_name' => 'MACHINERY AND EQUIPMENT', 'ppe_uacs' => '10605010', 'semi_ex_uacs' => '10405010'],
            ['article_name' => 'MEDICAL EQUIPMENT', 'ppe_uacs' => '10605110', 'semi_ex_uacs' => '10405100'],
            ['article_name' => 'MOTOR VEHICLE', 'ppe_uacs' => '10606010', 'semi_ex_uacs' => null],
            ['article_name' => 'OFFICE EQUIPMENT', 'ppe_uacs' => '10605020', 'semi_ex_uacs' => '10405020'],
            ['article_name' => 'OTHER EQUIPMENT', 'ppe_uacs' => '10605990', 'semi_ex_uacs' => null],
            ['article_name' => 'OTHER LAND IMPROVEMENTS', 'ppe_uacs' => '10602990', 'semi_ex_uacs' => null],
            ['article_name' => 'OTHER MACHINERY AND EQUIPMENT', 'ppe_uacs' => null, 'semi_ex_uacs' => '10405190'],
            ['article_name' => 'OTHER PPE', 'ppe_uacs' => '10698990', 'semi_ex_uacs' => null],
            ['article_name' => 'OTHER STRUCTURES', 'ppe_uacs' => '10604990', 'semi_ex_uacs' => null],
            ['article_name' => 'OTHER TRANSPORTATION EQUIPMENT', 'ppe_uacs' => '10606990', 'semi_ex_uacs' => null],
            ['article_name' => 'POWER SUPPLY SYSTEMS', 'ppe_uacs' => '10603050', 'semi_ex_uacs' => null],
            ['article_name' => 'PRINTING EQUIPMENT', 'ppe_uacs' => '10605120', 'semi_ex_uacs' => '10405110'],
            ['article_name' => 'SPORTS EQUIPMENT', 'ppe_uacs' => '10605130', 'semi_ex_uacs' => '10405120'],
            ['article_name' => 'TECHNICAL AND SCIENTIFIC EQUIPMENT', 'ppe_uacs' => '10605140', 'semi_ex_uacs' => '10405130'],
            ['article_name' => 'WATER SUPPLY SYSTEMS', 'ppe_uacs' => '10603040', 'semi_ex_uacs' => null],
            ['article_name' => 'WATERCRAFTS', 'ppe_uacs' => '10606040', 'semi_ex_uacs' => null],
        ];
    }
};