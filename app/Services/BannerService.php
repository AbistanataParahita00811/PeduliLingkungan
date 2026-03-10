<?php

namespace App\Services;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class BannerService
{
    public const MAX_ACTIVE = 4;

    public function __construct(
        protected BannerRepository $repository,
        protected ImageUploadService $uploader
    ) {
    }

    public function listForAdmin(): Collection
    {
        return $this->repository->allForAdmin();
    }

    public function create(StoreBannerRequest $request): Banner
    {
        $data = $this->prepareData($request->validated(), $request);

        $this->ensureActiveLimit($data['is_active'] ?? false);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploader->upload(
                $request->file('image'),
                'banners',
                ImageUploadService::BANNERS
            );
        }

        return $this->repository->create($data);
    }

    public function update(UpdateBannerRequest $request, Banner $banner): Banner
    {
        $data = $this->prepareData($request->validated(), $request);

        $becomesActive = ($data['is_active'] ?? $banner->is_active) && ! $banner->is_active;
        $this->ensureActiveLimit($becomesActive);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploader->upload(
                $request->file('image'),
                'banners',
                ImageUploadService::BANNERS
            );
        }

        return $this->repository->update($banner, $data);
    }

    public function delete(Banner $banner): void
    {
        $this->repository->delete($banner);
    }

    public function toggleActive(Banner $banner): Banner
    {
        $becomesActive = ! $banner->is_active;
        $this->ensureActiveLimit($becomesActive);

        return $this->repository->toggleActive($banner);
    }

    public function reorder(array $orders): void
    {
        $this->repository->updateOrder($orders);
    }

    /**
     * Normalisasi data berdasarkan mode banner.
     *
     * - Mode default: hanya gunakan backdrop (image, opsional), reset judul/deskripsi/CTA.
     * - Mode custom: gunakan judul, deskripsi, CTA, abaikan flag default.
     */
    protected function prepareData(array $data, $request): array
    {
        $isDefault = (bool) ($data['is_default'] ?? $request->boolean('is_default'));
        $data['is_default'] = $isDefault;

        $data['is_active'] = $request->boolean('is_active');

        if ($isDefault) {
            $data['title'] = null;
            $data['subtitle'] = null;
            $data['button_text'] = null;
            $data['button_url'] = null;
        }

        return $data;
    }

    protected function ensureActiveLimit(bool $becomesActive): void
    {
        if (! $becomesActive) {
            return;
        }

        if ($this->repository->countActive() >= self::MAX_ACTIVE) {
            throw ValidationException::withMessages([
                'is_active' => 'Maksimal hanya ' . self::MAX_ACTIVE . ' banner yang dapat diaktifkan sekaligus.',
            ]);
        }
    }
}

