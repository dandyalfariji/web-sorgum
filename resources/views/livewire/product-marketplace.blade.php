@php use Illuminate\Support\Facades\Storage; @endphp

<div class="bg-[#FFF8F3] dark:bg-[#0B221B] min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <h1 class="text-3xl font-bold text-center mb-2" style="color:#0AA55A">Produk Sorgummi</h1>
        <p class="text-center text-gray-700 dark:text-gray-300 mb-8">
            Temukan minuman sereal dan produk sorgum berkualitas lainnya.
        </p>

        {{-- Toolbar: Search + Kategori + Per Page --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

            {{-- Search box + button --}}
            <div class="flex w-full md:max-w-xl">
                <input
                    type="text"
                    class="w-full rounded-l-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Cari produk, kategori, deskripsi..."
                    wire:model.defer="searchInput"
                    x-on:keydown.enter="$wire.applySearch()"
                />
                <button
                    class="rounded-r-lg px-4 py-2 bg-emerald-600 text-white hover:bg-emerald-700"
                    wire:click="applySearch"
                    aria-label="Cari"
                >
                    Cari
                </button>
            </div>

            {{-- Per Page (opsional) --}}
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-300">Tampil:</span>
                <select
                    class="rounded-md border border-gray-300 px-2 py-1 bg-white dark:bg-green-900 dark:text-white"
                    wire:change="setPerPage($event.target.value)"
                >
                    <option value="12" @selected($perPage==12)>12</option>
                    <option value="16" @selected($perPage==16)>16</option>
                    <option value="20" @selected($perPage==20)>20</option>
                    <option value="24" @selected($perPage==24)>24</option>
                </select>
            </div>
        </div>

        {{-- Filter Kategori (Pills Buttons) --}}
        <div class="flex flex-wrap items-center gap-2 mb-8">
            <button
                class="px-3 py-1 rounded-full border text-sm
                       {{ $selectedCategory==='all' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-green-900 dark:text-white text-gray-700 border-gray-300 hover:bg-pink-600' }}"
                wire:click="setCategory('all')"
            >Semua</button>

            @foreach($categories as $cat)
                <button
                    class="px-3 py-1 rounded-full border text-sm
                           {{ $selectedCategory===$cat ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-green-900 dark:text-white text-gray-700 border-gray-300 hover:bg-pink-600' }}"
                    wire:click="setCategory('{{ $cat }}')"
                >{{ $cat }}</button>
            @endforeach
        </div>

        {{-- Grid Produk --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">
  @forelse ($products as $product)
    @php
      $fallback = asset('images/not found product.png');
      $imgSrc = ($product->image && Storage::disk('public')->exists($product->image))
          ? Storage::url($product->image)
          : $fallback;
    @endphp

    <a href="{{ route('product.detail', $product->slug) }}"
       class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 group
              h-full flex flex-col">   {{-- <- bikin kartu full height + kolom --}}
      
      {{-- AREA GAMBAR: kotak rasio, gambar tidak terpotong --}}
      <div class="relative bg-white">
        <!-- Jika Tailwind punya aspect-ratio -->
        <div class="aspect-[4/5] w-full">   {{-- seragamkan tinggi header gambar --}}
          <img
            src="{{ $imgSrc }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-contain"
            onerror="this.onerror=null;this.src='{{ $fallback }}';"
          />
        </div>

        <!-- Fallback tanpa plugin aspect-ratio (hapus blok di atas, pakai yang ini):
        <div class="relative w-full pt-[125%] bg-white">
          <img
            src="{{ $imgSrc }}"
            alt="{{ $product->name }}"
            class="absolute inset-0 w-full h-full object-contain"
            onerror="this.onerror=null;this.src='{{ $fallback }}';"
          />
        </div>
        -->
      </div>

      {{-- AREA KONTEN: dorong ke bawah supaya tinggi kartu konsisten --}}
      <div class="p-4 dark:bg-green-900 bg-green-200 flex-1 flex flex-col">
        <h2 class="text-lg font-semibold dark:text-green-400 text-green-700 truncate group-hover:text-rose-500">
          {{ $product->name }}
        </h2>
        <p class="text-sm dark:text-white text-gray-500 mb-2">
          {{ $product->category ?? 'Sorgum' }}
        </p>

        <div class="mt-auto flex items-center justify-between">  {{-- mt-auto -> footer nempel bawah --}}
          <p class="text-lg font-extrabold dark:text-white text-gray-900">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p>
        </div>
      </div>
    </a>
  @empty
    <p class="col-span-full text-center dark:text-white text-gray-500">
      Belum ada produk yang tersedia.
    </p>
  @endforelse
</div>


        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->onEachSide(1)->links() }}
        </div>
    </div>
</div>
