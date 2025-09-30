<footer class="p-6 sm:p-8 bg-white dark:bg-[#071A15] border-t border-gray-200 dark:border-white/10">
    <div class="mx-auto max-w-screen-xl">
        @if ($footer)
            <div class="md:flex md:justify-between md:items-start">
                <!-- Brand -->
                <div class="mb-8 md:mb-0">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('storage/' . $footer->logo_path) }}" class="mr-3 h-10 w-auto"
                            alt="{{ $footer->brand_name }} Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#0AA55A] dark:text-white">
                            {{ $footer->brand_name }}
                        </span>
                    </a>
                    <p class="mt-3 max-w-sm text-sm text-gray-700 dark:text-[#CBD5E1]">
                        {{ $footer->description }}
                    </p>
                </div>

                <!-- Kolom link (dinamis) -->
                <div class="grid grid-cols-2 gap-8 sm:gap-10 sm:grid-cols-3">
                    @foreach ($footer->link_columns as $column)
                        <div>
                            <h2 class="mb-4 text-sm font-semibold uppercase text-[#0AA55A] dark:text-white">
                                {{ $column['column_title'] }}
                            </h2>
                            @if (!empty($column['links']))
                                <ul class="space-y-3 text-gray-700 dark:text-[#CBD5E1]">
                                    @foreach ($column['links'] as $link)
                                        <li><a href="{{ $link['link_url'] }}"
                                                class="hover:text-[#E31067]">{{ $link['link_text'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <hr class="my-6 border-gray-200 dark:border-white/10 lg:my-8" />

            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-600 sm:text-center dark:text-[#A3B2BF]">
                    © <span class="font-semibold">{{ $footer->brand_name }}</span> {{ date('Y') }}.
                    {{ $footer->copyright_text }}
                </span>

                <!-- Social badges (dinamis) -->
                <div class="flex mt-6 space-x-4 sm:mt-0">
                    @if ($footer->whatsapp_url)
                        <a href="{{ $footer->whatsapp_url }}" target="_blank" rel="noopener noreferrer"
                            aria-label="WhatsApp"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white ring-1 ring-black/5 hover:ring-[#0AA55A] hover:scale-105 transition">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="#25D366" aria-hidden="true">
                                <path
                                    d="M20.52 3.48A11.94 11.94 0 0 0 12.04 0C5.44 0 .02 5.42.02 12.1c0 2.13.55 4.2 1.6 6.02L0 24l6.1-1.58a12.06 12.06 0 0 0 5.93 1.52h.01c6.62 0 12.03-5.41 12.03-12.07 0-3.22-1.26-6.25-3.55-8.39ZM12.04 22a9.96 9.96 0 0 1-5.06-1.38l-.36-.2-3.62.94.97-3.53-.23-.37A10.03 10.03 0 1 1 22.04 12c0 5.53-4.49 10-10 10Zm5.65-7.42c-.31-.16-1.83-.9-2.11-1.01-.28-.11-.49-.16-.69.16-.2.31-.79 1.01-.97 1.22-.18.2-.36.23-.67.08-.31-.16-1.3-.48-2.48-1.53-.92-.8-1.54-1.78-1.72-2.09-.18-.31-.02-.48.14-.63.14-.14.31-.36.46-.54.15-.18.2-.31.31-.51.1-.2.05-.38-.03-.54-.08-.16-.69-1.66-.95-2.27-.25-.6-.5-.51-.69-.52l-.59-.01c-.2 0-.52.08-.79.38-.27.31-1.03 1-1.03 2.42s1.06 2.8 1.21 2.99c.15.2 2.08 3.18 5.04 4.46.71.31 1.27.5 1.7.64.71.22 1.36.19 1.87.11.57-.09 1.83-.75 2.09-1.48.26-.73.26-1.36.18-1.49-.08-.13-.28-.21-.59-.37Z" />
                            </svg>
                        </a>
                    @endif
                    @if ($footer->instagram_url)
                        <a href="{{ $footer->instagram_url }}" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white ring-1 ring-black/5 hover:ring-[#0AA55A] hover:scale-105 transition">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="#E31067" aria-hidden="true">
                                <path
                                    d="M12 2.2c3 0 3.4.01 4.6.07 1.1.06 1.8.24 2.2.4.6.23 1 .5 1.5 1s.77.9 1 1.5c.16.4.34 1.1.4 2.2.06 1.2.07 1.6.07 4.6s-.01 3.4-.07 4.6c-.06 1.1-.24 1.8-.4 2.2a3.9 3.9 0 0 1-1 1.5 3.9 3.9 0 0 1-1.5 1c-.4.16-1.1.34-2.2.4-1.2.06-1.6.07-4.6.07s-3.4-.01-4.6-.07c-1.1-.06-1.8-.24-2.2-.4a3.9 3.9 0 0 1-1.5-1 3.9 3.9 0 0 1-1-1.5c-.16-.4-.34-1.1-.4-2.2C2.21 15.4 2.2 15 2.2 12s.01-3.4.07-4.6c.06-1.1.24-1.8.4-2.2.23-.6.5-1 .99-1.5.5-.5.91-.77 1.5-1 .4-.16 1.1-.34 2.2-.4C8.6 2.21 9 2.2 12 2.2Zm0 3.3c-2.95 0-3.3.01-4.46.07-.9.05-1.39.2-1.72.33-.43.17-.73.37-1.06.7-.33.33-.53.63-.7 1.06-.13.33-.28.81-.33 1.72-.06 1.16-.07 1.51-.07 4.46s.01 3.3.07 4.46c.05.9.2 1.39.33 1.72.17.43.37.73.7 1.06.33.33.63.53 1.06.7.33.13.81.28 1.72.33 1.16.06 1.51.07 4.46.07s3.3-.01 4.46-.07c.9-.05 1.39-.2 1.72-.33.43-.17.73-.37 1.06-.7.33-.33.53-.63.7-1.06.13-.33.28-.81.33-1.72.06-1.16.07-1.51-.07-4.46s-.01-3.3-.07-4.46c-.05-.9-.2-1.39-.33-1.72-.17-.43-.37-.73-.7-1.06a2.42 2.42 0 0 0-1.06-.7c-.33-.13-.81-.28-1.72-.33-1.16-.06-1.51-.07-4.46-.07Z" />
                                <path
                                    d="M12 8.3A5.7 5.7 0 1 1 6.3 14 5.7 5.7 0 0 1 12 8.3Zm0 2.2A3.5 3.5 0 1 0 15.5 14 3.5 3.5 0 0 0 12 10.5Zm5.7-3.4a1.1 1.1 0 1 1-1.1 1.1 1.1 1.1 0 0 1 1.1-1.1Z" />
                            </svg>
                        </a>
                    @endif
                    @if ($footer->tiktok_url)
                        <a href="{{ $footer->tiktok_url }}" target="_blank" rel="noopener noreferrer"
                            aria-label="TikTok"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white ring-1 ring-black/5 hover:ring-[#0AA55A] hover:scale-105 transition">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="#000000" aria-hidden="true">
                                <path
                                    d="M16.5 3a5.83 5.83 0 0 0 .06.92 5.01 5.01 0 0 0 3.6 4.08c.26.07.53.12.8.16v2.45a8.68 8.68 0 0 1-4.22-1.45v6.48A6.58 6.58 0 1 1 9.1 9.22v2.55a3.3 3.3 0 1 0 2.32 3.15V3h5.08Z" />
                            </svg>
                        </a>
                    @endif
                    @if ($footer->shopee_url)
                        <a href="{{ $footer->shopee_url }}" target="_blank" rel="noopener noreferrer"
                            aria-label="Shopee"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white ring-1 ring-black/5 hover:ring-[#0AA55A] hover:scale-105 transition">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true">
                                <path fill="#EE4D2D" d="M5 8h14l-1 11a2 2 0 0 1-2 1H8a2 2 0 0 1-2-1L5 8z" />
                                <path fill="#EE4D2D"
                                    d="M9 8V7.2A3.2 3.2 0 0 1 12.2 4h0A3.2 3.2 0 0 1 15.4 7.2V8h-1.6V7.2c0-.89-.71-1.6-1.6-1.6s-1.6.71-1.6 1.6V8H9z" />
                                <path fill="#ffffff"
                                    d="M12.2 16.9c-.97 0-1.86-.45-2.41-1.18l1.18-.88c.28.36.72.58 1.23.58.67 0 1.22-.38 1.22-.85 0-.47-.54-.85-1.22-.85h-.6v-1.3h.6c1.5 0 2.72.96 2.72 2.15 0 1.19-1.22 2.13-2.72 2.13z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center text-gray-500">
                <p>Footer content is not available. Please configure it in the admin panel.</p>
            </div>
        @endif
    </div>
</footer>
