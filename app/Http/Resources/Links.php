<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 10.12.19.
 * Time: 22.14
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Links extends JsonResource {


    public function toArray($request) {

        $user = Auth::user();

        $canDelete = $user && $this->user_id === $user->id;

        return [
            'id'              => $this->id,
            'original_url'    => $this->original_url,
            'code'            => $this->code,
            'requested_count' => $this->requested_count,
            'used_count'      => $this->used_count,
            'last_requested'  => $this->last_requested,
            'last_used'       => $this->last_used,
            'private'         => $this->private,
            'user_id'         => $this->user_id,
            'canDelete'       => $canDelete
        ];
    }
}
