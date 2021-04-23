<?php

namespace Database\Seeders;

use App\Models\StopWord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedStopWords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StopWord::firstOrCreate(['value' => 'and']);
        StopWord::firstOrCreate(['value' => 'or']);
        StopWord::firstOrCreate(['value' => 'be']);
        StopWord::firstOrCreate(['value' => 'from']);
        StopWord::firstOrCreate(['value' => 'etc']);
        DB::statement("SET GLOBAL innodb_ft_server_stopword_table = '" . env('DB_DATABASE') . "/stop_words'");
    }
}
