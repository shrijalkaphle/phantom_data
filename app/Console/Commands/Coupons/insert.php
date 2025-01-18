<?php

namespace App\Console\Commands\Coupons;
use Illuminate\Support\Facades\DB;


use Illuminate\Console\Command;

class insert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:coupons';

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
        function generateRandomCouponCode($length)
        {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $dataToInsert = [
            ['code' => 'abc123', 'discount' => '99', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'xyz123', 'discount' => '99', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('coupons')->truncate();
        DB::table('coupons')->insert($dataToInsert);
        echo "Coupon Inserted! ";
    }
}
