<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\LinkRepository;
use App\Services\CreateURLShortnerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LinkController extends Controller {

    /**
     * @var CreateURLShortnerService
     */
    protected $createURLShortnerService;

    /**
     * @var LinkRepository
     */
    protected $linkRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LinkRepository $linkRepository, CreateURLShortnerService $createURLShortnerService) {
        $this->createURLShortnerService = $createURLShortnerService;
        $this->linkRepository           = $linkRepository;
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        $links =  $this->linkRepository->fetchPublicLinks($request);
        return response()->json(['data' => $links], 200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, ['url' => 'required|url']);

        try {
            $link = $this->createURLShortnerService->setRequest($request)->handle();
            return response()->json(['data' => $link, 'message' => 'Shortened link created'], 201);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => 'Shortened link could not be created'], 409);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, string $code) {
        $this->validate($request, ['url' => 'required|url']);

        try {
            $link = $this->linkRepository->updateByCode($request->only(['url', 'private']), $code);
            return response()->json(['data' => $link, 'message' => 'Shortened link updated'], 200);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => 'Shortened link could not be updated'], 409);
        }
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function show(string $code) {
        try {
            $link = $this->linkRepository->findByCode($code);
            return response()->json(['data' => $link->original_url]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => sprintf('Shortened link not found by code (%s)', $code)], 500);
        }
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $code) {
        try {
            $this->linkRepository->deleteByCode($code);
            return response()->json(['message' => 'Shortened link deleted'], 200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => true, 'message' => 'Shortened link could not be deleted'], 409);
        }
    }
}
