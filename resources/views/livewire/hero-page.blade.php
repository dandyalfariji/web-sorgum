<section class="bg-[#FFF8F3] dark:bg-[#0B221B]" id="home">
    @if ($heroData)
        {{-- HERO TOP --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 py-10 lg:py-16">

                {{-- Text --}}
                <div class="order-2 lg:order-1 lg:col-span-7 self-center">
                    <h1
                        class="mb-4 font-extrabold leading-tight tracking-tight text-3xl sm:text-4xl md:text-5xl xl:text-6xl"
                        style="color:#0AA55A">
                        {{ $heroData->headline }}
                    </h1>

                    <p class="mb-8 text-base sm:text-lg lg:text-xl font-light text-gray-700 dark:text-gray-300">
                        {{ $heroData->description }}
                    </p>

                    <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3">
                        <a href="{{ $heroData->primary_button_url }}"
                           class="inline-flex items-center justify-center text-white font-semibold rounded-lg text-sm px-5 py-3
                                  focus:outline-none focus:ring-4 w-full sm:w-auto"
                           style="background-color:#E31067;--tw-ring-color:#FBD1E1">
                            {{ $heroData->primary_button_text }}
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="{{ $heroData->secondary_button_url }}"
                           class="inline-flex items-center justify-center rounded-lg text-sm px-5 py-3 border
                                  hover:bg-[#EAF9F2] focus:outline-none focus:ring-4 w-full sm:w-auto"
                           style="color:#0AA55A;border-color:#0AA55A;--tw-ring-color:#CDEFE0">
                            {{ $heroData->secondary_button_text }}
                        </a>
                    </div>
                </div>

                {{-- Image --}}
                @if ($heroData->hero_image_path)
                    <div class="order-1 lg:order-2 lg:col-span-5">
                        <div class="w-full max-w-[640px] mx-auto">
                            <img
                                src="{{ Storage::url($heroData->hero_image_path) }}"
                                alt="Sorgummi mockup"
                                class="w-full h-auto rounded-xl object-contain"
                                loading="eager"
                                decoding="async"
                                sizes="(min-width: 1024px) 40vw, 90vw">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- MID SECTION --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 items-center gap-8 xl:gap-16 py-10 sm:py-16">
                @if ($heroData->mid_section_image_path)
                    <div class="order-1 flex justify-center">
                        <img
                            class="mx-auto h-auto object-contain rounded-xl"
                            style="max-width: 320px; width: 100%;"
                            src="{{ Storage::url($heroData->mid_section_image_path) }}"
                            alt="Logo halal"
                            loading="lazy"
                            decoding="async">
                    </div>
                @endif

                <div class="order-2 mt-4 md:mt-0">
                    <h2 class="mb-4 text-3xl sm:text-4xl font-extrabold tracking-tight text-[#0AA55A] dark:text-white">
                        {{ $heroData->mid_section_headline }}
                    </h2>
                    <p class="font-light text-base md:text-lg text-gray-700 dark:text-[#CBD5E1]">
                        {{ $heroData->mid_section_description }}
                    </p>
                </div>
            </div>
        </div>

        {{-- CTA MARKETPLACE --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-16 sm:py-24 mt-8 relative overflow-hidden bg-[#0B221B] rounded-2xl shadow-2xl border border-emerald-900">
                <div class="grid md:grid-cols-2 gap-8 items-center px-6 sm:px-10">
                    <div class="text-center md:text-left z-10">
                        <h2 class="mb-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight text-white tracking-tight">
                            {{ $heroData->cta_headline }}
                        </h2>
                        
                        <p class="mb-10 font-light text-lg md:text-xl text-white leading-relaxed">
                            {{ $heroData->cta_description }}
                        </p>

                        <div class="flex flex-col sm:flex-row justify-center md:justify-start items-center gap-4">
                            <a href="{{ $heroData->cta_button_url }}"
                               class="inline-flex items-center justify-center font-bold rounded-full text-base px-8 py-3.5 shadow-lg transition-transform hover:scale-105"
                               style="background-color: #E31067; color: white; text-decoration: none; min-width: 180px; box-shadow: 0 4px 14px 0 rgba(227, 16, 103, 0.39);">
                                {{ $heroData->cta_button_text }}
                            </a>
                        </div>
                    </div>

                    @if ($heroData->cta_image_path)
                        <div class="flex justify-center z-10">
                            <img src="{{ Storage::url($heroData->cta_image_path) }}" 
                                 alt="CTA Image" 
                                 class="w-auto h-auto max-w-[240px] max-h-[240px] object-contain rounded-xl shadow-md transition-transform hover:scale-105 duration-300 mx-auto">
                        </div>
                    @else
                        <div class="flex justify-center z-10">
                            {{-- Placeholder jika belum ada gambar yang diupload --}}
                            <div class="w-full max-w-md aspect-square bg-[#081813] rounded-xl shadow-md flex items-center justify-center border-2 border-dashed border-emerald-800">
                                <span class="text-white text-center px-4">Gambar CTA<br><small>(Upload via Admin)</small></span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-16">
                <p class="text-gray-500 dark:text-gray-400">
                    Hero Section not configured. Please set an active hero section in the admin panel.
                </p>
            </div>
        </div>
    @endif
</section>
