<?php

namespace App\Http\Middleware;

use App\Models\Carrency;
use App\Models\Icons;
use App\Models\Region;
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
                    ] : null,
                    'icons' =>[
                        'cat1' =>[
                            'title' => 'clothes',
                            'items' => Icons::where('categories', 'clothes')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat2' =>[
                            'title' => 'food',
                            'items' => Icons::where('categories', 'food')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat3' =>[
                            'title' => 'electronics',
                            'items' => Icons::where('categories', 'electronics')
                            ->pluck('items','id_icons')
                            ->all(),
                        ],
                        'cat4' =>[
                            'title' => 'transportation',
                            'items' => Icons::where('categories', 'transportation')
                            ->pluck('items','id_icons')
                            ->all(),
                        ]
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
                    'carrency' => Carrency::select('id_carrency', 'currency')->get()
                ];
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
