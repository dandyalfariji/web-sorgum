<section class="bg-[#FFF8F3] dark:bg-[#0B221B]" id="partner">
    <div class="py-8 lg:py-16 mx-auto max-w-screen-xl px-4">
        <h2 class="mb-8 lg:mb-12 text-3xl font-extrabold tracking-tight leading-tight text-center text-[#0AA55A] dark:text-white md:text-4xl">
            Partner & Kolaborator Sorgumology
        </h2>

        {{-- Logika perulangan yang sudah diperbaiki --}}
        @if ($partners->isNotEmpty())
            {{-- Container flex berada di LUAR perulangan --}}
            <div class="flex flex-wrap items-center justify-center gap-10 sm:gap-12 md:gap-16">
                @foreach ($partners as $partner)
                    {{-- Perulangan hanya me-render link dan image --}}
                    <a href="{{ $partner->url ?? '#' }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center justify-center transition-transform hover:scale-[1.05] opacity-80 hover:opacity-100 "
                        title="{{ $partner->name }}">
                        <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}"
                            class="h-10 md:h-12 object-contain transition" loading="lazy" />
                    </a>
                @endforeach
            </div>
        @else
             {{-- Pesan ini akan tampil jika tidak ada partner --}}
            <div class="text-center text-gray-500 dark:text-gray-400">
                <p>Saat ini belum ada partner yang ditampilkan.</p>
            </div>
        @endif

    </div>
</section>
