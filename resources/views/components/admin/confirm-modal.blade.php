<div
    x-data="{ open: false, url: null }"
    @open-confirm.window="open = true; url = $event.detail.url"
>
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
        @click.self="open = false"
    >
        <div
            x-show="open"
            x-transition
            class="bg-white rounded-xl shadow-xl max-w-sm w-full p-6"
        >
            <p class="text-gray-700 mb-4">Yakin ingin menghapus data ini?</p>
            <div class="flex gap-3 justify-end">
                <button
                    type="button"
                    @click="open = false"
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300"
                >
                    Batal
                </button>
                <form :action="url" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 inline-flex items-center gap-2"
                    >
                        <x-icons name="trash" class="w-4 h-4" />
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
