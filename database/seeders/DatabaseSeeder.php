<?php

namespace Database\Seeders;

use App\Models\Carrency;
use App\Models\Icons;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //delete it
        User::factory()->create([
            'name' => 'oussema',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'avatar'=>'../../../public/icon/sid_bar/avatar/avatar1.png',
            'sid_img'=> '../../../public/icon/sid_bar/wallpapers/img_1.jpg',
            'filter'=>'#ffc502',
        ]);

        //icons
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
        //region
        $Beja = ['Béja Nord',
                    'Nefza',
                    'Medjez el-Bab',
                    'Béja Sud',
                    'Testour',
                    'Téboursouk'
                    ,'Amdoun',
                    'Goubellat'];
        $Ariana = ['Ariana Ville',
                    'La Soukra',
                    'Ettadhamen',
                    'Raoued',
                    'Mnihla',
                    'Kaläat el-Andalous',
                    'Sidi Thabet'];
        $Manouba = ['Douar Hicher',
                    'Oued Ellil',
                    'La Manouba',
                    'Tebourba',
                    'Djedeida',
                    'Mornaguia',
                    'El Batan',
                    'Borj El Amri'];
        $Tunis = [  'Hraïria',
                    'El Kabaria',
                    'Sidi Hassine',
                    'La Marsa',
                    'Le Bardo',
                    'El Omrane supérieur',
                    'Le Kram',
                    'El Menzah',
                    'El Omrane',
                    'Ezzouhour',
                    'Bab El Bhar',
                    'Cité El Khadra',
                    'Séjoumi',
                    'El Ouardia',
                    'Bab Souika',
                    'Sidi El Béchir',
                    'La Goulette',
                    'Médina',
                    'Djebel Jelloud',
                    'Ettahrir',
                    'Carthage'];
        $Kasserine = ['SbeTtla',
                    'Kasserine Nord',
                    'Fériana',
                    'Sbiba',
                    'Foussana',
                    'Thala',
                    'Majel Bel Abbés',
                    'Kasserine Sud',
                    'Ezzouhour',
                    'El Ayoun',
                    'Hassi El Ferid',
                    'Jedelienne',
                    'HaTdra'];
        $Kairouan = ['Kairouan Nord',
                    'Kairouan Sud',
                    'Bou Hajla',
                    'Sbikha',
                    'Haffouz',
                    'Nasrallah',
                    'Oueslatia',
                    'Hajeb El Ayoun',
                    'Chebika',
                    'El Aläa',
                    'Echrarda',];
        $Jendouba = ['Jendouba Sud',
                    'Ghardimaou',
                    'Fernana',
                    'Tabarka',
                    'Jendouba Nord',
                    'Balta-Bou Aouane',
                    'Ain Draham',
                    'Bou Salem',
                    'Oued Meliz'];
        $Kef = ['Kef Est',
                'Dahmani',
                'Tajerouine',
                'Kef Ouest',
                'Nebeur',
                'Sers',
                'Sakiet Sidi Youssef',
                'El Ksour',
                'Kalaat Senan',
                'Jérissa',
                'Kaläat Khasba'];
        $Mahdia = ['Mahdia',
                    'Ksour Essef',
                    'Essouassi',
                    'a Jem',
                    'Sidi Alouane',
                    'Bou Merdes',
                    'Chorbane',
                    'Chebba',
                    'Ouled Chamekh',
                    'Mellouléche',
                    'Hebira'];
        $Monastir = ['Monastir',
                    'Moknine',
                    'Jemmal',
                    'Ksar Hellal',
                    'Téboulba',
                    'Ksibet el-Médiouni',
                    'Bembla',
                    'Zéramdine',
                    'Sayada-Lamta-Bou Hajar',
                    'Sahline',
                    'Ouerdanine',
                    'Bekalta',
                    'Beni Hassen'];
        $Bizerte = ['Bizerte Nord',
                    'Menzel Bourguiba',
                    'Ras Jebel',
                    'Mateur',
                    'Bizerte Sud',
                    'Sejnane',
                    'Menzel Jemil',
                    'Joumine',
                    'Ghezala',
                    'El Alia',
                    'Zarzouna',
                    'Tinja',
                    'Ghar El Melh',
                    'Utique',];
        $Nabeul = ['Hammamet',
                    'Korba',
                    'Nabeul',
                    'Menzel Temime',
                    'Grombalia',
                    'Kélibia',
                    'Soliman',
                    'Dar Chaäbane El Fehri',
                    'El Haouaria',
                    'Béni Khiar',
                    'Béni Khalled',
                    'Menzel Bouzelfa',
                    'Bou Argoub',
                    'El Mida',
                    'Takelsa',
                    'Hammam Ghezéze'];
        $Siliana = ['Makthar',
                    'Rouhia',
                    'Siliana Sud',
                    'Siliana Nord',
                    'El Krib',
                    'Bou Arada',
                    'Gaäfour',
                    'Kesra',
                    'Sidi Bou Rouis',
                    'Bargou',
                    'El Aroussa',];
        $Sousse = ['Msaken',
                    'Sousse Riadh',
                    'Sousse Jawhara',
                    'Kaläa Kebira',
                    'Sousse Sidi Abdelhamid',
                    'Enfida',
                    'Hammam Sousse',
                    'Sousse Médina',
                    'Kaläa Seghira',
                    'Akouda',
                    'Bouficha',
                    'Sidi Bou Ali',
                    'Kondar',
                    'Sidi El Hani',
                    'Hergla'];
        $Ben_Arous = ['El Mourouj',
                        'Fouchana',
                        'Mornag',
                        'Mohamedia',
                        'Radés',
                        'Medina Jedida',
                        'Hammam Lif',
                        'Ben Arous',
                        'Ezzahra',
                        'Bou Mhel el-Bassatine',
                        'Hammam Chott',
                        'Mégrine',];
        $Medenine = ['Zarzis',
                    'Ben Gardane',
                    'Djerba - Houmt Souk',
                    'Djerba - Midoun',
                    'Médenine Nord',
                    'Médenine Sud',
                    'Beni Khedache',
                    'Djerba - Ajim',
                    'Sidi Makhlouf'];
        $Gabes = ['El Hamma',
                    'Gabés Sud',
                    'Mareth',
                    'Gabés Médina',
                    'Gabés Ouest',
                    'Métouia',
                    'Ghannouch',
                    'Nouvelle Matmata',
                    'Menzel El Habib',
                    'Matmata',];
        $Gafsa = ['Gafsa Sud',
                    'Métlaoui',
                    'Sened',
                    'El Ksar',
                    'Moularés',
                    'Redeyef',
                    'El Guettar',
                    'Belkhir',
                    'Mdhilla',
                    'Gafsa Nord',
                    'Sidi Afch'];
        $Kebili = ['Kébili Sud',
                    'Kébili Nord',
                    'Souk Lahad',
                    'Douz Nord',
                    'Douz Sud',
                    'Faouar'];
        $Sfax = ['Sfax Ville','Sfax Ouest','Sfax Sud','Sakiet Eddaïer',
                'Sakiet Ezzit','Bir Ali Ben Khalifa','El Hencha',
                'Agareb','Menzel Chaker','Mahrès','Skhira'
        ];
        $Sidi_Bouzid = ['Sidi Bouzid Ouest',
                        'Regueb',
                        'Sidi Bouzid Est',
                        'Jilma',
                        'Bir El Hafey',
                        'Sidi Ali Ben Aoun',
                        'Menzel Bouzaiane',
                        'Mezzouna',
                        'Meknassy',
                        'Ouled Haffouz',
                        'Souk Jedid',
                        'Cebbala Ouled Asker'];
        $Tataouine = ['Tataouine Nord',
                    'Tataouine Centre-EstSud',
                    'Ghomrassen',
                    'Smär',
                    'Remada',
                    'Bir Lahmar',
                    'Dehiba'];
        $Tozeur = ['Tozeur',
                    'Degache',
                    'Nefta',
                    'Tameghza',
                    'Hazoua'];
        $Zaghouan = ['El Fahs',
                    'Zaghouan',
                    'Nadhour',
                    'Bir Mcherga',
                    'Zriba',
                    'Saouaf'];
                    

        foreach ($Beja as $beja) {
            DB::table('regions')->insert([
                'region' => 'beja',
                'state' => $beja,
            ]);
        }
        foreach ($Ariana as $ariana) {
            DB::table('regions')->insert([
                'region' => 'Ariana',
                'state' => $ariana,
            ]);
        }
        foreach ($Manouba as $manouba) {
            DB::table('regions')->insert([
                'region' => 'Manouba',
                'state' => $manouba,
            ]);
        }
        foreach ($Tunis as $tunis) {
            DB::table('regions')->insert([
                'region' => 'Tunis',
                'state' => $tunis,
            ]);
        }
        foreach ($Kasserine as $kasserine) {
            DB::table('regions')->insert([
                'region' => 'Kasserine',
                'state' => $kasserine,
            ]);
        }
        foreach ($Kairouan as $kairouan) {
            DB::table('regions')->insert([
                'region' => 'Kairouan',
                'state' => $kairouan,
            ]);
        }
        foreach ($Jendouba as $jendouba) {
            DB::table('regions')->insert([
                'region' => 'Jendouba',
                'state' => $jendouba,
            ]);
        }
        foreach ($Kef as $kef) {
            DB::table('regions')->insert([
                'region' => 'Kef',
                'state' => $kef,
            ]);
        }
        foreach ($Mahdia as $mahdia) {
            DB::table('regions')->insert([
                'region' => 'Mahdia',
                'state' => $mahdia,
            ]);
        }
        foreach ($Monastir as $monastir) {
            DB::table('regions')->insert([
                'region' => 'Monastir',
                'state' => $monastir,
            ]);
        }
        foreach ($Bizerte as $bizerte) {
            DB::table('regions')->insert([
                'region' => 'Bizerte',
                'state' => $bizerte,
            ]);
        }
        foreach ($Nabeul as $nabeul) {
            DB::table('regions')->insert([
                'region' => 'Nabeul',
                'state' => $nabeul,
            ]);
        }
        foreach ($Siliana as $siliana) {
            DB::table('regions')->insert([
                'region' => 'Siliana',
                'state' => $siliana,
            ]);
        }
        foreach ($Sousse as $sousse) {
            DB::table('regions')->insert([
                'region' => 'Sousse',
                'state' => $sousse,
            ]);
        }
        foreach ($Ben_Arous as $ben_Arous) {
            DB::table('regions')->insert([
                'region' => 'Ben_Arous',
                'state' => $ben_Arous,
            ]);
        }
        foreach ($Medenine as $medenine) {
            DB::table('regions')->insert([
                'region' => 'Medenine',
                'state' => $medenine,
            ]);
        }
        foreach ($Gabes as $gabes) {
            DB::table('regions')->insert([
                'region' => 'Gabes',
                'state' => $gabes,
            ]);
        }
        foreach ($Gafsa as $gafsa) {
            DB::table('regions')->insert([
                'region' => 'Gafsa',
                'state' => $gafsa,
            ]);
        }
        foreach ($Kebili as $kebili) {
            DB::table('regions')->insert([
                'region' => 'Kebili',
                'state' => $kebili,
            ]);
        }
        foreach ($Sidi_Bouzid as $sidi_Bouzid) {
            DB::table('regions')->insert([
                'region' => 'Sidi_Bouzid',
                'state' => $sidi_Bouzid,
            ]);
        }
        foreach ($Sfax as $sfax) {
            DB::table('regions')->insert([
                'region' => 'Sfax',
                'state' => $sfax,
            ]);
        }
        foreach ($Tataouine as $tataouine) {
            DB::table('regions')->insert([
                'region' => 'Tataouine',
                'state' => $tataouine,
            ]);
        }
        foreach ($Tozeur as $tozeur) {
            DB::table('regions')->insert([
                'region' => 'Tozeur',
                'state' => $tozeur,
            ]);
        }
        foreach ($Zaghouan as $zaghouan) {
            DB::table('regions')->insert([
                'region' => 'Zaghouan',
                'state' => $zaghouan,
            ]);
        }

        //carrency
        $currencies = [
            'TND',
            'USD',
            'EUR',
            'JPY',
            // Add more currencies as needed
        ];
        foreach ($currencies as $currency) {
            DB::table('carrencies')->insert([
                'currency' => $currency,
            ]);
        }
    }
}
