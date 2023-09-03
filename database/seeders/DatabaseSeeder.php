<?php

namespace Database\Seeders;

use App\Models\Icons;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $clothes = ['boot', 'short','cap',
                    'eyeglasses','gloves',
                    'hat','long-short','shirt',
                    'shoes','socks','t-shirt'];
        $foods = ['cafe', 'cake','chicken',
                    'cola','donut','freekase',
                    'fruits','hamburger','ice_cream',
                    'juice','milk','pizza','resteaux',
                    'ty','vegtebuls'];
        $electronics = ['camera', 'casque','central_unit',
                    'controller_game','cooler','CPU',
                    'keyboard','laptop','memory_ram',
                    'microphone','monitor','mouse','server',
                    'SIM','smartphone','smartwatsh',
                    'storage','usb'];
        $transportations = ['airplane', 'bus','car',
                    'delivery','motor','ship',
                    'taxi','train'];

                    foreach ($clothes as $clothe) {
                        DB::table('icons')->insert([
                            'categories' => 'clothes',
                            'items' => $clothe,
                        ]);
                    }
                    foreach ($foods as $food) {
                        DB::table('icons')->insert([
                            'categories' => 'food',
                            'items' => $food,
                        ]);
                    }
                    foreach ($electronics as $electronic) {
                        DB::table('icons')->insert([
                            'categories' => 'electronics',
                            'items' => $electronic,
                        ]);
                    }
                    foreach ($transportations as $transportation) {
                        DB::table('icons')->insert([
                            'categories' => 'transportation',
                            'items' => $transportation,
                        ]);
                    }
    }
}
