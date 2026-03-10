@extends('admin.layouts.dashboard')

@section('page_title', 'Testimonial')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Testimonial</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="px-3 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
            + Tambah Testimonial
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-4 space-y-3">
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left">Avatar</th>
                    <th class="py-2 text-left">Nama</th>
                    <th class="py-2 text-left">Peran</th>
                    <th class="py-2 text-left">Quote</th>
                    <th class="py-2 text-left">Status</th>
                    <th class="py-2 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($testimonials as $testimonial)
                    <tr class="border-b last:border-0">
                        <td class="py-2">
                            @if($testimonial->image_url)
                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-moss/10 flex items-center justify-center text-[11px] text-moss">
                                    {{ mb_substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                        </td>
                        <td class="py-2 text-forest">
                            {{ $testimonial->name }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $testimonial->role }}
                        </td>
                        <td class="py-2 text-gray-700">
                            <span class="line-clamp-2">“{{ $testimonial->quote }}”</span>
                        </td>
                        <td class="py-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $testimonial->is_active ? 'bg-leaf/20 text-forest' : 'bg-gray-100 text-gray-500' }}">
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-2 text-right">
                            <div class="inline-flex gap-1">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="px-2 py-1 rounded-md border border-gray-200 text-[11px]">
                                    Edit
                                </a>
                                <form action="{{ route('admin.testimonials.toggle', $testimonial) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded-md border border-lime/40 text-[11px] text-forest">
                                        {{ $testimonial->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Hapus testimonial ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 rounded-md border border-red-200 text-[11px] text-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">
                            Belum ada testimonial. Tambahkan minimal satu testimonial untuk mengisi section di homepage.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

