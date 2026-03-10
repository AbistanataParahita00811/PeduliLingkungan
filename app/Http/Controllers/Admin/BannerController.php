<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    public function __construct(protected BannerService $service)
    {
    }

    public function index()
    {
        $banners = $this->service->listForAdmin();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        try {
            $this->service->create($request);

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Banner berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function show(Banner $banner)
    {
        return redirect()->route('admin.banners.edit', $banner);
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try {
            $this->service->update($request, $banner);

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Banner berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function destroy(Banner $banner)
    {
        $this->service->delete($banner);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }

    public function toggle(Banner $banner)
    {
        try {
            $this->service->toggleActive($banner);

            return redirect()
                ->route('admin.banners.index')
                ->with('success', 'Status banner diperbarui.');
        } catch (ValidationException $e) {
            return redirect()
                ->route('admin.banners.index')
                ->with('error', collect($e->errors())->flatten()->first() ?? 'Tidak dapat memperbarui status banner.');
        }
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => ['required', 'array'],
            'orders.*' => ['integer', 'min:0'],
        ]);

        $this->service->reorder($request->input('orders', []));

        return redirect()->route('admin.banners.index')->with('success', 'Urutan banner diperbarui.');
    }
}

