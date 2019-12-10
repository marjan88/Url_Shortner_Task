<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LinkRepository;
use Illuminate\Support\Facades\Log;

class LinkController extends Controller {

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
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function show(string $code) {
        try {
            $link = $this->linkRepository->findByCode($code);
            header("Location: {$link->original_url}");
            exit();
        } catch (\Exception $e) {
            Log::error($e);
            abort(404);
        }
    }


}
