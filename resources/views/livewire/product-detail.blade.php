@php
    use Illuminate\Support\Facades\Storage;

    $fallback = asset('images/not found product.png');

    // Tentukan sumber gambar utama
    $mainSrc = $mainImage && Storage::disk('public')->exists($mainImage) ? Storage::url($mainImage) : $fallback;

    // Helper kecil untuk thumbnail (dipakai di bawah)
    $thumbSrc = function ($path) use ($fallback) {
        return $path && Storage::disk('public')->exists($path) ? Storage::url($path) : $fallback;
    };
@endphp

<div class="bg-[#FFF8F3] dark:bg-[#0B221B] font-sans min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Kolom Kiri: Galeri Gambar -->
            <div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                    <img src="{{ $mainSrc }}" alt="Main product image"
                        class="w-full h-auto max-h-[500px] object-contain bg-white transition-transform duration-500 ease-in-out hover:scale-105"
                        onerror="this.onerror=null;this.src='{{ $fallback }}';">
                </div>
                <div class="grid grid-cols-5 gap-2">
                    {{-- Thumbnail Utama --}}
                    @php
                        $baseThumbSrc = $thumbSrc($product->image);
                    @endphp
                    <div class="cursor-pointer border-2 {{ $mainImage == $product->image ? 'border-pink-600' : 'border-transparent' }} rounded-lg overflow-hidden"
                        wire:click="changeImage('{{ $product->image }}')" title="Gambar utama">
                        <img src="{{ $baseThumbSrc }}" alt="Product thumbnail" class="w-full h-auto max-h-20 object-contain bg-white"
                            onerror="this.onerror=null;this.src='{{ $fallback }}';">
                    </div>

                    {{-- Thumbnails Tambahan --}}
                    @if (!empty($product->images))
                        @foreach ($product->images as $image)
                            @php
                                $thisThumbSrc = $thumbSrc($image);
                            @endphp
                            <div class="cursor-pointer border-2 {{ $mainImage == $image ? 'border-pink-600' : 'border-transparent' }} rounded-lg overflow-hidden"
                                wire:click="changeImage('{{ $image }}')" title="Gambar tambahan">
                                <img src="{{ $thisThumbSrc }}" alt="Product thumbnail" class="w-full h-auto max-h-20 object-contain bg-white"
                                    onerror="this.onerror=null;this.src='{{ $fallback }}';">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Info & Aksi -->
            <div class="flex flex-col">
                <h1 class="text-3xl lg:text-4xl font-bold dark:text-green-400 text-gray-800">{{ $product->name }}</h1>
                <div class="flex items-center my-3">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-yellow-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                        <span class="dark:text-white text-gray-600 font-semibold ml-1">{{ $product->rating }}</span>
                    </div>
                    <span class="mx-2 dark:text-gray-300 text-gray-800">|</span>
                    <span class="text-sm dark:text-green-600 text-gray-600 font-semibold">Stok:
                        {{ $product->stock }}</span>
                </div>
                <p class="text-3xl font-extrabold text-pink-600 mb-4">Rp
                    {{ number_format($product->price, 0, ',', '.') }}</p>

                {{-- Aksi --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-2">
                    {{-- Kembali ke Marketplace --}}
                    <a href="{{ route('marketplace') }}" {{-- ganti ke route daftar produk milikmu jika berbeda --}}
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-3
               rounded-lg border border-emerald-600 text-emerald-700
               hover:bg-emerald-50 dark:border-emerald-500 dark:text-emerald-300 dark:hover:bg-green-900/40
               font-semibold transition-colors duration-300"
                        aria-label="Kembali ke halaman marketplace" {{-- wire:navigate  --}}>
                        ← Kembali ke Marketplace
                    </a>

                    {{-- Beli Sekarang --}}
                    <a href="#" {{-- isi dengan route checkout/cart milikmu, mis. route('cart.add', $product->id) --}}
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-3
               rounded-lg bg-green-500 text-white font-bold
               hover:bg-green-600 transition-colors duration-300"
                        aria-label="Beli sekarang">
                        <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                    </a>
                </div>

            </div>
        </div>

        <!-- Tab Detail & Ulasan -->
        <div class="mt-12">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button wire:click="$set('activeTab', 'detail')"
                        class="{{ $activeTab === 'detail' ? 'border-pink-600 text-pink-600' : 'border-transparent dark:text-white text-gray-500 hover:text-green-500 hover:border-green-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Detail Produk
                    </button>
                    <button wire:click="$set('activeTab', 'spesifikasi')"
                        class="{{ $activeTab === 'spesifikasi' ? 'border-pink-600 text-pink-600' : 'border-transparent dark:text-white text-gray-500 hover:text-green-500 hover:border-green-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Spesifikasi
                    </button>
                    <button wire:click="$set('activeTab', 'ulasan')"
                        class="{{ $activeTab === 'ulasan' ? 'border-pink-600 text-pink-600' : 'border-transparent dark:text-white text-gray-500 hover:text-green-500 hover:border-green-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Ulasan Produk
                    </button>
                </nav>
            </div>

            <div class="mt-6">
                @if ($activeTab === 'detail')
                    <div class="prose max-w-none dark:text-white text-gray-600">
                        {!! \Illuminate\Support\Str::markdown($product->description ?? '') !!}
                    </div>
                @elseif ($activeTab === 'spesifikasi')
                    <div>
                        <p class="dark:text-white text-gray-600">Informasi spesifikasi belum tersedia.</p>
                    </div>
                @elseif ($activeTab === 'ulasan')
                    <div>
                        <p class="dark:text-white text-gray-600">Belum ada ulasan untuk produk ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
````