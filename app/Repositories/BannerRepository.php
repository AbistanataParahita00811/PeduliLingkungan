<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Support\Collection;

class BannerRepository
{
    public function allForAdmin(): Collection
    {
        return Banner::query()
            ->ordered()
            ->get();
    }

    public function activeForHero(int $limit = 4): Collection
    {
        return Banner::query()
            ->active()
            ->ordered()
            ->take($limit)
            ->get();
    }

    public function create(array $data): Banner
    {
        return Banner::create($data);
    }

    public function update(Banner $banner, array $data): Banner
    {
        $banner->update($data);

        return $banner;
    }

    public function delete(Banner $banner): void
    {
        $banner->delete();
    }

    public function toggleActive(Banner $banner): Banner
    {
        $banner->is_active = ! $banner->is_active;
        $banner->save();

        return $banner;
    }

    public function updateOrder(array $orders): void
    {
        foreach ($orders as $id => $order) {
            Banner::whereKey($id)->update(['order_index' => (int) $order]);
        }
    }

    public function countActive(): int
    {
        return Banner::query()
            ->active()
            ->count();
    }
}

