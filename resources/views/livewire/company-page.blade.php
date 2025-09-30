<section class="bg-[#FFF8F3] dark:bg-[#0B221B]" id="company">

    {{-- Tambahkan kondisi ini untuk memastikan seksi hanya tampil jika datanya ada --}}
    @if ($companyPage)
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <!-- Text Content (Dynamic) -->
            <div class="font-light text-gray-700 sm:text-lg dark:text-[#CBD5E1]">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-[#0AA55A] dark:text-white">
                    {{ $companyPage->headline }}
                </h2>
                <p class="mb-4">
                    {!! $companyPage->paragraph_1 !!}
                </p>
                <p>
                    {!! $companyPage->paragraph_2 !!}
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ $companyPage->button_1_link }}"
                        class="inline-flex items-center px-5 py-2.5 rounded-lg text-sm font-semibold text-white focus:ring-4"
                        style="background-color:#E31067;--tw-ring-color:#FBD1E1">
                        {{ $companyPage->button_1_text }}
                    </a>
                    <a href="{{ $companyPage->button_2_link }}"
                        class="inline-flex items-center px-5 py-2.5 rounded-lg text-sm border hover:bg-[#EAF9F2] focus:ring-4"
                        style="color:#0AA55A;border-color:#0AA55A;--tw-ring-color:#CDEFE0">
                        {{ $companyPage->button_2_text }}
                    </a>
                </div>
            </div>

            <!-- Images (Dynamic) -->
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="{{ asset('storage/' . $companyPage->image_1) }}"
                    alt="{{ $companyPage->image_1_alt }}">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('storage/' . $companyPage->image_2) }}"
                    alt="{{ $companyPage->image_2_alt }}">
            </div>
        </div>
    @else
        {{-- Pesan ini akan tampil jika data belum diisi di Filament --}}
        <div class="py-16 text-center text-gray-500">
            <p>Konten untuk seksi "Company" belum diatur. Silakan atur melalui panel admin.</p>
        </div>
    @endif
</section>
