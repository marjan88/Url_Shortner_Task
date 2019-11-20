<?php

namespace App\Http\Controllers;

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
        $this->linkRepository           = $linkRepository;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $user = $request->user();
        return $this->linkRepository->fetchByUserId($request, $user->id);
    }
}
