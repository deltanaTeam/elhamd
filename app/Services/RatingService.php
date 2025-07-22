<?php

// app/Services/RatingService.php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Support\Facades\DB;

class RatingService
{
    public function submitRating(array $data): ProductRating
    {
        return DB::transaction(function () use ($data) {
            $rating = ProductRating::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                    'product_id' => $data['product_id']
                ],
                [
                    'rating' => $data['rating'],
                    'review' => $data['review'] ?? null,
                    'order_id' => $data['order_id'] ?? null,
                    'is_approved' => $this->needsApproval($data)
                ]
            );

            if ($rating->wasRecentlyCreated || $rating->wasChanged()) {
                $this->updateProductStats($rating->product);
            }

            return $rating;
        });
    }

    protected function needsApproval(array $data): bool
    {
        // يمكنك إضافة شروط الموافقة التلقائية هنا
        return !($data['user_id'] === 1); // مثال: المدير لا يحتاج موافقة
    }

    public function updateProductStats(Product $product): void
    {
        $product->recalculateRatings();
    }

    public function approveRating(ProductRating $rating, int $approverId): void
    {
        DB::transaction(function () use ($rating, $approverId) {
            $rating->update([
                'is_approved' => true,
                'approved_at' => now(),
                'approved_by' => $approverId
            ]);

            $this->updateProductStats($rating->product);
        });
    }
}