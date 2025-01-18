<?php

namespace App\Console\Commands\sampleData;
use Illuminate\Support\Facades\DB;


use Illuminate\Console\Command;

class AddSampleData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:sampledata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataToInsert=[
            ['title' => 'Ranchview, California, USA', 'views' => '39000', 'status' => '1','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Muza link road, ca, usa', 'views' => '39', 'status' => '2','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Board Baxar, Califronia, USA', 'views' => '6754', 'status' => '3','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Green Road, Uttara, BD', 'views' => '22', 'status' => '1','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Willowbrook, California, USA', 'views' => '1204', 'status' => '2','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Oakridge, California, USA', 'views' => '900', 'status' => '3','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Lakeview, California, BD', 'views' => '467', 'status' => '1','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Springwood, California, Uttara', 'views' => '205', 'status' => '2','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Brookside, California, USA', 'views' => '603', 'status' => '3','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
            ['title' => 'Pinehurst, California, USA', 'views' => '802', 'status' => '1','action'=>'NULL','created_at' => now(), 'updated_at' =>now()],
          
     ];

        DB::table('sample_data')->truncate();

        DB::table('sample_data')->insert($dataToInsert);
        echo "Data Inserted ! ";
    }
}
