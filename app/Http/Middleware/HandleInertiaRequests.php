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
                    ] : null,
                    'icons' =>[
                        'cat1' =>[
                            'title' => 'clothes',
                            'items' => Icons::where('categories', 'clothes')
                            ->pluck('items')
                        ],
                        'cat2' =>[
                            'title' => 'food',
                            'items' => Icons::where('categories', 'food')
                            ->pluck('items')
                        ],
                        'cat3' =>[
                            'title' => 'electronics',
                            'items' => Icons::where('categories', 'electronics')
                            ->pluck('items')
                        ],
                        'cat4' =>[
                            'title' => 'transportation',
                            'items' => Icons::where('categories', 'transportation')
                            ->pluck('items')
                        ]
                    ],
                    'regions' =>[
                        'regions1' =>[
                            'region' => 'Beja',
                            'state' => Region::where('region', 'beja')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions2' =>[
                            'region' => 'Ariana',
                            'state' => Region::where('region', 'Ariana')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions3' =>[
                            'region' => 'Manouba',
                            'state' => Region::where('region', 'Manouba')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions4' =>[
                            'region' => 'Tunis',
                            'state' => Region::where('region', 'Tunis')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions5' =>[
                            'region' => 'Kasserine',
                            'state' => Region::where('region', 'Kasserine')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions6' =>[
                            'region' => 'Kairouan',
                            'state' => Region::where('region', 'Kairouan')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions7' =>[
                            'region' => 'Jendouba',
                            'state' => Region::where('region', 'Jendouba')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions8' =>[
                            'region' => 'Kef',
                            'state' => Region::where('region', 'Kef')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions9' =>[
                            'region' => 'Mahdia',
                            'state' => Region::where('region', 'Mahdia')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions10' =>[
                            'region' => 'Monastir',
                            'state' => Region::where('region', 'Monastir')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions11' =>[
                            'region' => 'Bizerte',
                            'state' => Region::where('region', 'Bizerte')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions12' =>[
                            'region' => 'Nabeul',
                            'state' => Region::where('region', 'Nabeul')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions13' =>[
                            'region' => 'Siliana',
                            'state' => Region::where('region', 'Siliana')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions14' =>[
                            'region' => 'Sousse',
                            'state' => Region::where('region', 'Sousse')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions15' =>[
                            'region' => 'Ben_Arous',
                            'state' => Region::where('region', 'Ben_Arous')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions16' =>[
                            'region' => 'Medenine',
                            'state' => Region::where('region', 'Medenine')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions17' =>[
                            'region' => 'Gabes',
                            'state' => Region::where('region', 'Gabes')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions18' =>[
                            'region' => 'Gafsa',
                            'state' => Region::where('region', 'Gafsa')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions19' =>[
                            'region' => 'Kebili',
                            'state' => Region::where('region', 'Kebili')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions20' =>[
                            'region' => 'Sfax',
                            'state' => Region::where('region', 'Sfax')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions21' =>[
                            'region' => 'Sidi_Bouzid',
                            'state' => Region::where('region', 'Sidi_Bouzid')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions22' =>[
                            'region' => 'Tataouine',
                            'state' => Region::where('region', 'Tataouine')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions23' =>[
                            'region' => 'Tozeur',
                            'state' => Region::where('region', 'Tozeur')
                            ->pluck('state','id')
                            ->all(),
                        ],
                        'regions24' =>[
                            'region' => 'Zaghouan',
                            'state' => Region::where('region', 'Zaghouan')
                            ->pluck('state','id')
                            ->all(),
                        ],            
                    ],
                    'carrency' => Carrency::select('id', 'currency')->get()
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
