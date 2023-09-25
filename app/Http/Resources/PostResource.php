<?php
namespace App\Http\Resources;

use App\Models\Post;
use Dedoc\Scramble\Support\InferExtensions\JsonResourceExtension;
use Illuminate\Http\Request;


/**
 * @property Post $resource
 */
class PostResource extends JsonResourceExtension
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return array
     */
    public function toArray()
    {
        return [$this->id];
    }
}
