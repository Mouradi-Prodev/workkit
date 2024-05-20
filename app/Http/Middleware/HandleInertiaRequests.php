<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Inertia\Middleware;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

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
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'permissions' => [
                    'team' => [
                        'view' => $request->user() ? $request->user()->can('view', Team::class) : null,
                    ],
                    'chatroom' =>[
                        'create' => $request->user() ? $request->user()->can('create', ChatRoom::class) : null,
                    ]
                ],
                'team' => $request->user() ? $request->user()->team : null,
            ],
        ];
    }
}
