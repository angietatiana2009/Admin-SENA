<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE apprentices MODIFY cell_number VARCHAR(20) NOT NULL');
    }

    public function down(): void
    {
        $hasValuesOutsideIntegerRange = DB::table('apprentices')
            ->whereRaw(
                "cell_number NOT REGEXP '^-?[0-9]+$' OR CAST(cell_number AS DECIMAL(65, 0)) NOT BETWEEN -2147483648 AND 2147483647"
            )
            ->exists();

        if ($hasValuesOutsideIntegerRange) {
            throw new RuntimeException('Cannot restore integer cell numbers without losing data.');
        }

        DB::statement('ALTER TABLE apprentices MODIFY cell_number INT NOT NULL');
    }
};
