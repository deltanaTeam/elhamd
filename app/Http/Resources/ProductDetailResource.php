<?php

namespace App\Http\Resources;
use App\Http\Resources\MediaResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PharmacistProductRatingResource;
use App\Http\Resources\UserProductRatingResource;
use App\Http\Resources\OfferProductResource;
use App\Http\Resources\ProductResource;
class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'id' => $this->id,
          'name_ar' => $this->getTranslation('name',"ar") ,
          'name_en' => $this->getTranslation('name',"en") ,
          'generic_name' => $this->generic_name,
          'type' => $this->type ,
          'form' => $this->form ,
          'strength' => $this->strength ,
          'price' => round($this->price, 2) ,
          'average_rating' => [
              'user' => round($this->ratings_avg_rate, 2),
              'pharmacist' => round($this->pharmacist_ratings_avg_rate, 2),
          ],
          'tax_rate' => $this->tax_rate ,
          'production_date' => $this->production_date ,
          'expiry_date' => $this->expiry_date ,
          'barcode' => $this->barcode ,
          'pack_size' => $this->pack_size ,
          'description' => $this->description,
          'position' => $this->position,
          'active' => $this->active,
          'show_home' => $this->show_home,
          'categoryName' => $this->category->name,
          'brandName' => $this->brand->name,
          'imageUrl' => $this->getFirstMediaUrlTeam(),
          'image' => new MediaResource($this->getFirstMedia()),
          'gallery' => $this->getMediaResource('gallery') ?: null,
          'offer'         => $this->offer ? new OfferResource($this) : null,
             'imageUrl'      => $this->getFirstMediaUrl(),

             'user_rating_avg'       => round($this->ratings->avg('rate'), 2),
             'pharmacist_rating_avg' => round($this->pharmacistRatings->avg('rate'), 2),

             'user_comments' => UserProductRatingResource::collection($this->ratings),
             'pharmacist_comments' => PharmacistProductRatingResource::collection($this->pharmacistRatings),

             'similar_products' => ProductResource::collection(
                 Product::where('id', '!=', $this->id)
                     ->where('category_id', $this->category_id)
                     ->where('active', true)
                     ->take(6)
                     ->get()
             )

      ];
    }
}
