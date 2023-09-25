<?php
namespace App\Http\Resources;

use App\Models\Product;
use Dedoc\Scramble\Support\InferExtensions\JsonResourceExtension;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray($data)
    {
        return [
            'id' => 1,
        ];
    }
}
