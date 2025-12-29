<header class="sticky top-0 z-50 w-full">
    <nav class="bg-white dark:bg-[#071C16] border-b border-gray-200 dark:border-white/10 px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" wire:navigate class="flex items-center" wire:click="setActive('home')">
                {{-- Logo dinamis --}}
                <img src="{{ asset($logoUrl) }}" class="mr-3 w-20" alt="Sorgummi Logo" />
            </a>

            {{-- Right: hamburger (tidak berubah) --}}
            <div class="flex items-center lg:order-2">
                <button type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-600 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="{{ $open ? 'true' : 'false' }}"
                    wire:click="toggleMenu">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5h14v2H3V5zm0 5h14v2H3v-2zm0 5h14v2H3v-2z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            @php
                $base = 'block py-2 pr-4 pl-3 rounded lg:p-0 transition-colors';
                $hover = 'lg:hover:text-[#E31067]';
                $on = 'text-[#0AA55A] font-semibold';
                $off = 'text-gray-700 dark:text-gray-300';
                $cls = fn($k) => "{$base} {$hover} " . ($active === $k ? $on : $off);
            @endphp

            {{-- Menu list dinamis --}}
            <div class="{{ $open ? 'block' : 'hidden' }} justify-between items-center w-full lg:flex lg:w-auto lg:order-1"
                id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    {{-- Loop melalui item menu dari database --}}
                    @if(isset($menuItems) && $menuItems->isNotEmpty())
                        @foreach ($menuItems as $item)
                            <li>
                                <a href="{{ $item->url }}"
                                    @if(Str::contains($item->url, 'marketplace')) wire:navigate @endif
                                    wire:click="setActive('{{ $item->wire_click_key }}')"
                                    class="{{ $cls($item->wire_click_key) }}"
                                    aria-current="{{ $active === $item->wire_click_key ? 'page' : 'false' }}">
                                    {{ $item->label }}
                                </a>
                            </li>
                        @endforeach
                    @else
                         <li><a href="#" class="{{ $cls('none') }}">No menu items configured.</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
