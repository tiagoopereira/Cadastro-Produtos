<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CreateProductService
{
    public function create(string $name, ?array $tags): Product
    {
        DB::beginTransaction();

        $product = Product::create(['name' => $name]);
        $this->addTagsToProduct($product, $tags);

        DB::commit();

        return $product;
    }

    public function addTagsToProduct(Product $product, ?array $tags): void
    {
        if ($this->validateAllTagsAreRemoved($product, $tags)) {
            return;
        }

        if (is_null($tags)) {
            return;
        }

        $this->validateExistingTagHasBeenRemoved($product, $tags);

        foreach ($tags as $tag) {
            if (!$product->tags->contains($tag)) {
                $product->tags()->save(Tag::find($tag));
            }
        }
    }

    private function validateAllTagsAreRemoved(Product $product, ?array $tags): bool
    {
        if (count($product->tags) && is_null($tags)) {
            $product->tags()->detach();
            $product->refresh();

            return true;
        }

        return false;
    }

    private function validateExistingTagHasBeenRemoved(Product $product, ?array $tags)
    {
        if (count($product->tags) && !is_null($tags)) {
            foreach ($product->tags as $tag) {
                if (!in_array($tag->id, $tags)) {
                    $product->tags()->detach($tag->id);
                }
            }
        }
    }
}