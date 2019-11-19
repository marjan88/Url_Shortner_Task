<?php

namespace App\Services;


use App\Helpers\UrlPatternInterface;
use App\Models\Link;
use App\Repositories\Contracts\LinkRepository;

class CreateURLShortnerService extends AbstractService {
    /**
     * @var LinkRepository
     */
    protected $linkRepository;

    /**
     * @var UrlPatternInterface
     */
    protected $urlPattern;

    /**
     * CreateURLShortnerService constructor.
     * @param LinkRepository $linkRepository
     * @param UrlPatternInterface $urlPattern
     */
    public function __construct(LinkRepository $linkRepository, UrlPatternInterface $urlPattern) {
        $this->linkRepository = $linkRepository;
        $this->urlPattern = $urlPattern;
    }

    /**
     * @param $url
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle() {
        $request = $this->getRequest();
        $url     = $request->get('url');

        $data = [
            'original_url' => $url,
            'user_id'      => $request->user()->id
        ];

        $link = $this->linkRepository->create($data);

        $link->increment('requested_count');

        $link->touchTimestamp('last_requested');

        $link->code = $this->urlPattern->create($link->id);
        $link->update();

        return $link;
    }
}
