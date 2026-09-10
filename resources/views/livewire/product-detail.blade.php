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

<div class="bg-[#FFF8F3] dark:bg-[#0B221B] font-sans min-h-screen pb-0">
    <livewire:header-page />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:max-w-6xl pb-10">
        
        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="{{ route('marketplace') }}" class="inline-flex items-center text-white bg-emerald-500 hover:bg-emerald-600 font-semibold transition-all shadow-sm hover:shadow text-sm px-4 py-2 rounded-lg w-fit">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Breadcrumb -->
        <div class="mb-4">
            <nav class="flex text-sm text-gray-500 space-x-2">
                <a href="/" class="hover:text-emerald-600 transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('marketplace') }}" class="hover:text-emerald-600 transition-colors">Marketplace</a>
                <span>/</span>
                <span class="text-gray-800 dark:text-gray-300 font-semibold truncate max-w-[150px] sm:max-w-xs">{{ $product->name }}</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            
            <!-- Card Kiri: Galeri Gambar -->
            <div class="lg:col-span-5 flex flex-col gap-3">
                <div class="bg-white dark:bg-[#071C16] rounded-2xl shadow-sm border border-gray-100 dark:border-white/10 p-3 sm:p-4 flex flex-col h-full">
                    <img src="{{ $mainSrc }}" alt="Main product image"
                        class="w-full flex-1 h-0 min-h-[300px] object-cover transition-transform duration-500 hover:scale-105 rounded-xl bg-gray-50/50 dark:bg-gray-800/50"
                        onerror="this.onerror=null;this.src='{{ $fallback }}';">
                    
                    <div class="grid grid-cols-5 gap-2 sm:gap-3 mt-4 shrink-0">
                        {{-- Thumbnail Utama --}}
                        @php $baseThumbSrc = $thumbSrc($product->image); @endphp
                        <div class="cursor-pointer border-2 {{ $mainImage == $product->image ? 'border-emerald-500' : 'border-transparent hover:border-gray-300' }} rounded-xl overflow-hidden transition-all p-1 sm:p-1.5 bg-gray-50 dark:bg-gray-800"
                            wire:click="changeImage('{{ $product->image }}')" title="Gambar utama">
                            <img src="{{ $baseThumbSrc }}" alt="Product thumbnail" class="w-full aspect-square object-contain"
                                onerror="this.onerror=null;this.src='{{ $fallback }}';">
                        </div>

                        {{-- Thumbnails Tambahan --}}
                        @if (!empty($product->images))
                            @foreach ($product->images as $image)
                                @php $thisThumbSrc = $thumbSrc($image); @endphp
                                <div class="cursor-pointer border-2 {{ $mainImage == $image ? 'border-emerald-500' : 'border-transparent hover:border-gray-300' }} rounded-xl overflow-hidden transition-all p-1 sm:p-1.5 bg-gray-50 dark:bg-gray-800"
                                    wire:click="changeImage('{{ $image }}')" title="Gambar tambahan">
                                    <img src="{{ $thisThumbSrc }}" alt="Product thumbnail" class="w-full aspect-square object-contain"
                                        onerror="this.onerror=null;this.src='{{ $fallback }}';">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Detail & Pembelian (Tanpa Background Putih agar menyatu dengan Tema) -->
            <div class="lg:col-span-7 py-0 lg:pl-2">
                <!-- Tag Baru -->
                <span class="inline-block px-3 py-1 mb-2 text-[11px] font-bold tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-100/50 dark:bg-emerald-900/30 rounded-md uppercase">
                    PRODUK SORGUMMI
                </span>

                <!-- Judul -->
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white leading-snug mb-3 pb-3 border-b border-gray-200 dark:border-gray-700">
                    {{ $product->name }}
                </h1>
                
                <!-- Harga -->
                <div class="mb-4">
                    <p class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">
                        Rp {{ number_format($currentPrice, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Varian (Kotak-kotak) -->
                @if(is_array($product->variants) && count($product->variants) > 0)
                <div class="mb-4">
                    <div class="flex items-center gap-3 mb-3">
                        <h3 class="font-bold text-gray-900 dark:text-white text-sm">Pilih Varian</h3>
                        <span class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 flex items-center">
                            <svg class="w-3 h-3 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                            Sisa {{ $product->stock }} Stok
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-2 sm:gap-3">
                        @foreach($product->variants as $index => $variant)
                            <label class="cursor-pointer relative">
                                <input type="radio" wire:model.live="selectedVariantIndex" value="{{ $index }}" class="sr-only peer">
                                <div class="px-4 py-2 sm:px-5 sm:py-2 border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-[#071C16] rounded-lg text-gray-700 dark:text-gray-300 font-semibold text-xs transition-all peer-checked:border-emerald-600 peer-checked:text-emerald-700 dark:peer-checked:text-emerald-400 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-900/30 hover:border-emerald-400 dark:hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 hover:text-emerald-700 dark:hover:text-emerald-400 shadow-sm text-center">
                                    {{ $variant['name'] }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Deskripsi -->
                <div class="mb-5">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-2">Deskripsi:</h3>
                    <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                        {!! \Illuminate\Support\Str::markdown($product->description ?? '') !!}
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-3">Informasi Pengiriman</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-0 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-[#071C16] overflow-hidden shadow-sm divide-y sm:divide-y-0 sm:divide-x divide-gray-200 dark:divide-gray-700">
                        <div class="flex flex-row sm:flex-col gap-2 items-center sm:items-start p-3">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            <div>
                                <p class="text-[11px] text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Pengiriman</p>
                                <p class="text-[11px] font-bold text-gray-800 dark:text-gray-200 mt-0.5 leading-tight">Universitas Telkom Fakultas Ilmu Terapan, Lab Sorgumology</p>
                            </div>
                        </div>
                        <div class="flex flex-row sm:flex-col gap-2 items-center sm:items-start p-3">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <div>
                                <p class="text-[11px] text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Jasa Kirim</p>
                                <p class="text-[11px] font-bold text-gray-800 dark:text-gray-200 mt-0.5 leading-tight">Sekitar Area Telkom University</p>
                            </div>
                        </div>
                        <div class="flex flex-row sm:flex-col gap-2 items-center sm:items-start p-3">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <p class="text-[11px] text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Estimasi</p>
                                <p class="text-[11px] font-bold text-gray-800 dark:text-gray-200 mt-0.5 leading-tight">2 Hari</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Beli -->
                <div class="mb-4">
                    @php 
                        $variantName = $selectedVariantIndex !== null && isset($product->variants[$selectedVariantIndex]) ? ' (' . $product->variants[$selectedVariantIndex]['name'] . ')' : '';
                        $waMessage = "Halo, saya tertarik untuk membeli produk *{$product->name}{$variantName}* yang ada di Sorgummi.";
                        $waUrl = "https://wa.me/?text=" . urlencode($waMessage);
                    @endphp
                    
                    <a href="{{ $waUrl }}" target="_blank"
                        class="w-full flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.127.551 4.2 1.597 6.02L0 24l6.095-1.583a12.062 12.062 0 0 0 5.936 1.523h.007c6.643 0 12.029-5.386 12.029-12.032C24.067 5.385 18.674 0 12.031 0zm0 21.938h-.007a9.967 9.967 0 0 1-5.06-1.378l-.362-.215-3.623.949.972-3.535-.236-.376A9.99 9.99 0 0 1 2.064 12c0-5.521 4.492-10 10.013-10 5.518 0 10.01 4.48 10.01 10.002 0 5.522-4.492 10.006-10.006 10.006zm5.65-7.422c-.31-.155-1.832-.904-2.113-1.008-.282-.104-.488-.155-.694.155-.205.31-.798 1.008-.978 1.215-.181.206-.363.232-.673.077-.31-.155-1.306-.482-2.49-1.545-.921-.825-1.543-1.843-1.724-2.152-.181-.31-.019-.478.136-.632.14-.14.31-.362.464-.543.155-.181.206-.31.31-.517.104-.207.052-.388-.026-.543-.078-.155-.694-1.674-.951-2.292-.251-.606-.505-.523-.694-.533l-.592-.01c-.206 0-.543.077-.827.388-.285.31-1.087 1.06-1.087 2.585s1.113 2.998 1.268 3.205c.155.207 2.186 3.335 5.295 4.673.74.318 1.317.508 1.767.65.742.235 1.417.202 1.947.123.593-.09 1.832-.749 2.091-1.472.258-.724.258-1.345.181-1.473-.078-.129-.285-.207-.594-.362z"/>
                        </svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <livewire:footer-page />
</div>