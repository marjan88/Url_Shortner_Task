<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LinkRepository;
use Illuminate\Http\Request;

class UserLinkController extends Controller {
    /**
     * @var LinkRepository
     */
    protected $linkRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LinkRepository $linkRepository) {
        $this->linkRepository = $linkRepository;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $user  = $request->user();
        $links = $this->linkRepository->fetchByUserId($request, $user->id);
        return response()->json(['data' => $links], 200);
    }
}
