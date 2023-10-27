<?php

namespace App\Http\Middleware;

use App\Models\Carrency;
use App\Models\Companys;
use App\Models\Icons;
use App\Models\Region;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\DB;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // 'auth' => [
            //     'user' => $request->user(),
            // ],
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'email' => $request->user()->email,
                        'avatar' => $request->user()->avatar,
                        'sid_img' => $request->user()->sid_img,
                        'filter' => $request->user()->filter,
                        'main_currency' => $request->user()->main_currency,
                        'Post' => $request->user()->Post,
                    ] : null,
                    'recent_icon' => $request->user() ? [
                        Items::select('items.*','icons.*')
                        ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get(),
                    ] : null,
                    'user_company' => $request->user() ? [
                        Companys::select('companys.*')
                        ->join('memebers', 'memebers.id_company', '=', 'companys.company_id')
                        ->where('memebers.user_id',Auth::user()->id)
                        ->get(),
                    ] : null,
                    'carrency' => Carrency::select('id_carrency', 'currency')->get(),
                    'Allicons'=> Icons::select('categories','items','id_icons')
                            ->orderBy('created_at', 'desc')
                            ->get(),
                    'icons' =>[
                        'cat1' =>[
                            'title' => 'Food',
                            'categories'=>'food',
                            'items' => Icons::where('categories', 'food')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat2' =>[
                            'title' => 'Clothes',
                            'categories'=>'clothes',
                            'items' => Icons::where('categories', 'clothes')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat3' =>[
                            'title' => 'Téléphone & Tablettes',
                            'categories'=>'Téléphone_Tablette',
                            'items' => Icons::where('categories', 'Téléphone_Tablette')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat4' =>[
                            'title' => 'Electronic',
                            'categories'=>'electronic',
                            'items' => Icons::where('categories', 'electronic')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat5' =>[
                            'title' => 'video games',
                            'categories'=>'video_game',
                            'items' => Icons::where('categories', 'video_game')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat6' =>[
                            'title' => 'Transportation',
                            'categories'=>'transportation',
                            'items' => Icons::where('categories', 'transportation')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat7' =>[
                            'title' => 'Vehicles',
                            'categories'=>'Vehicle',
                            'items' => Icons::where('categories', 'Vehicle')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat8' =>[
                            'title' => 'Kitchen & Appliances',
                            'categories'=>'Cuisine_Électroménager',
                            'items' => Icons::where('categories', 'Cuisine_Électroménager')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat9' =>[
                            'title' => 'Sports articles',
                            'categories'=>'Articles_de_sport',
                            'items' => Icons::where('categories', 'Articles_de_sport')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat10' =>[
                            'title' => 'Garden Outdoors',
                            'categories'=>'Jardin_Plein_air',
                            'items' => Icons::where('categories', 'Jardin_Plein_air')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat11' =>[
                            'title' => 'Home & Offices',
                            'categories'=>'Maison_Bureau',
                            'items' => Icons::where('categories', 'Maison_Bureau')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat12' =>[
                            'title' => 'Health & Beauty',
                            'categories'=>'Santé_Beauté',
                            'items' => Icons::where('categories', 'Santé_Beauté')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat13' =>[
                            'title' => 'Education',
                            'categories'=>'education',
                            'items' => Icons::where('categories', 'education')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat14' =>[
                            'title' => 'Other categories',
                            'categories'=>'Autres_catégorie',
                            'items' => Icons::where('categories', 'Autres_catégorie')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                    ],
                    'regions' =>[
                        'regions1' =>[
                            'region' => 'Beja',
                            'state' => Region::where('region', 'beja')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions2' =>[
                            'region' => 'Ariana',
                            'state' => Region::where('region', 'Ariana')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions3' =>[
                            'region' => 'Manouba',
                            'state' => Region::where('region', 'Manouba')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions4' =>[
                            'region' => 'Tunis',
                            'state' => Region::where('region', 'Tunis')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions5' =>[
                            'region' => 'Kasserine',
                            'state' => Region::where('region', 'Kasserine')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions6' =>[
                            'region' => 'Kairouan',
                            'state' => Region::where('region', 'Kairouan')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions7' =>[
                            'region' => 'Jendouba',
                            'state' => Region::where('region', 'Jendouba')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions8' =>[
                            'region' => 'Kef',
                            'state' => Region::where('region', 'Kef')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions9' =>[
                            'region' => 'Mahdia',
                            'state' => Region::where('region', 'Mahdia')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions10' =>[
                            'region' => 'Monastir',
                            'state' => Region::where('region', 'Monastir')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions11' =>[
                            'region' => 'Bizerte',
                            'state' => Region::where('region', 'Bizerte')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions12' =>[
                            'region' => 'Nabeul',
                            'state' => Region::where('region', 'Nabeul')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions13' =>[
                            'region' => 'Siliana',
                            'state' => Region::where('region', 'Siliana')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions14' =>[
                            'region' => 'Sousse',
                            'state' => Region::where('region', 'Sousse')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions15' =>[
                            'region' => 'Ben_Arous',
                            'state' => Region::where('region', 'Ben_Arous')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions16' =>[
                            'region' => 'Medenine',
                            'state' => Region::where('region', 'Medenine')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions17' =>[
                            'region' => 'Gabes',
                            'state' => Region::where('region', 'Gabes')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions18' =>[
                            'region' => 'Gafsa',
                            'state' => Region::where('region', 'Gafsa')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions19' =>[
                            'region' => 'Kebili',
                            'state' => Region::where('region', 'Kebili')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions20' =>[
                            'region' => 'Sfax',
                            'state' => Region::where('region', 'Sfax')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions21' =>[
                            'region' => 'Sidi_Bouzid',
                            'state' => Region::where('region', 'Sidi_Bouzid')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions22' =>[
                            'region' => 'Tataouine',
                            'state' => Region::where('region', 'Tataouine')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions23' =>[
                            'region' => 'Tozeur',
                            'state' => Region::where('region', 'Tozeur')
                            ->pluck('state','id_region')
                            ->all(),
                        ],
                        'regions24' =>[
                            'region' => 'Zaghouan',
                            'state' => Region::where('region', 'Zaghouan')
                            ->pluck('state','id_region')
                            ->all(),
                        ],            
                    ],
                ];
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
