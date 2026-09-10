<div x-data="{
    darkMode: localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleDark() {
        this.darkMode = !this.darkMode;
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    },
    copyText(text) {
        navigator.clipboard.writeText(text);
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    },
    copied: false
}" class="min-h-screen flex flex-col font-sans text-gray-900 dark:text-gray-100 selection:bg-emerald-500 selection:text-white transition-colors duration-500 relative" 
x-bind:style="darkMode ? 'background-color: #050f0a;' : 'background-color: #f4f7f6;'">

    {{-- Subtle Background Pattern/Gradient --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-emerald-300/20 dark:bg-emerald-900/20 rounded-full blur-[100px]"></div>
        <div class="absolute top-[60%] -right-[10%] w-[40%] h-[40%] bg-teal-300/20 dark:bg-teal-900/20 rounded-full blur-[100px]"></div>
    </div>

    {{-- Centered Card Wrapper --}}
    <div class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8 z-10">
        
        {{-- Chat Widget Card --}}
        <div class="w-full max-w-md h-[85vh] sm:h-[800px] max-h-[90vh] bg-[#f8fafc] dark:bg-[#111c16] rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col border border-gray-100 dark:border-gray-800 ring-1 ring-black/5 dark:ring-white/5 relative">
            
            {{-- Header (Gradient) --}}
            <header class="shrink-0 relative z-20 px-6 py-5 rounded-t-[2.5rem]" style="background: linear-gradient(135deg, #10b981 0%, #0d9488 100%); box-shadow: 0 4px 20px rgba(16, 185, 129, 0.2);">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-white/90 p-0.5 shadow-inner flex items-center justify-center">
                                <div class="w-full h-full bg-white rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/sorgummi logo.png') }}" class="w-8 h-8 object-contain" alt="Sorgummi AI">
                                </div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-400 rounded-full border-2 border-[#10b981] shadow-sm"></div>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg tracking-wide leading-tight">Sorgummi AI</h2>
                            <p class="text-xs text-emerald-50/90 font-medium tracking-wider">Asisten Virtual Anda</p>
                        </div>
                    </div>
                    
                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2">
                        <button @click="toggleDark()" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all backdrop-blur-sm">
                            <svg x-show="!darkMode" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            <svg x-show="darkMode" class="w-4 h-4 text-amber-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </button>
                        <button wire:click="resetChat" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all backdrop-blur-sm" title="Mulai Baru">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </button>
                        <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all backdrop-blur-sm" title="Tutup">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    </div>
                </div>
            </header>

            {{-- Chat Messages Area --}}
            <main class="flex-1 overflow-y-auto scroll-smooth min-h-0 relative bg-white dark:bg-[#111c16]" id="chat-container">
                <div class="px-5 py-6 space-y-6">
                    @foreach($chatHistory as $index => $chat)
                        @if($index === 0) 
                            {{-- Welcome Message --}}
                            <div class="flex flex-col items-center justify-center text-center px-4 mb-6 mt-4">
                                <div class="w-16 h-16 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Halo!</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed mb-6">
                                    Saya Sorgummi AI 🌾 Asisten virtual Anda seputar sorgum, kesehatan, resep, dan produk Sorgummi. Ada yang bisa saya bantu hari ini?
                                </p>

                                {{-- Suggestion Chips (Only show if no conversation yet) --}}
                                @if(count($chatHistory) === 1)
                                    <div class="flex flex-wrap gap-2 justify-center w-full">
                                        <button wire:click="sendMessage('Apa saja manfaat gizi sorgum?')" class="px-4 py-2 bg-white dark:bg-gray-800 border border-emerald-100 dark:border-emerald-900/50 rounded-full text-sm font-medium text-emerald-700 dark:text-emerald-400 shadow-sm hover:shadow-md hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-all duration-200">
                                            Manfaat Gizi Sorgum
                                        </button>
                                        <button wire:click="sendMessage('Rekomendasi resep minuman sehat dari sorgum')" class="px-4 py-2 bg-white dark:bg-gray-800 border border-emerald-100 dark:border-emerald-900/50 rounded-full text-sm font-medium text-emerald-700 dark:text-emerald-400 shadow-sm hover:shadow-md hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-all duration-200">
                                            Ide Resep Sehat
                                        </button>
                                        <button wire:click="sendMessage('Apa keunggulan produk Sorgummi?')" class="px-4 py-2 bg-white dark:bg-gray-800 border border-emerald-100 dark:border-emerald-900/50 rounded-full text-sm font-medium text-emerald-700 dark:text-emerald-400 shadow-sm hover:shadow-md hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-all duration-200">
                                            Info Produk
                                        </button>
                                    </div>
                                @endif
                            </div>
                            @continue 
                        @endif

                        @if($chat['role'] === 'user')
                            {{-- User Message Bubble --}}
                            <div class="flex justify-end animate-[fadeSlideUp_0.3s_ease-out]">
                                <div class="text-white px-5 py-3 rounded-2xl rounded-tr-sm text-[15px] shadow-sm leading-relaxed max-w-[85%] break-words" style="background: linear-gradient(135deg, #34d399 0%, #059669 100%);">
                                    {!! nl2br(e($chat['content'])) !!}
                                </div>
                            </div>
                        @else
                            {{-- AI Message Bubble --}}
                            <div class="flex gap-3 animate-[fadeSlideUp_0.3s_ease-out] w-full" x-data="{ showActions: false }" @mouseenter="showActions = true" @mouseleave="showActions = false">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 overflow-hidden bg-emerald-50 dark:bg-gray-800 shadow-sm border border-emerald-100 dark:border-gray-700">
                                    <img src="{{ asset('images/sorgummi logo.png') }}" class="w-5 h-5 object-contain" alt="AI">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="bg-gray-50 dark:bg-gray-800/80 border border-gray-100 dark:border-gray-700/50 px-5 py-4 rounded-2xl rounded-tl-sm text-[15px] shadow-sm inline-block max-w-[95%]">
                                        <div class="prose prose-sm md:prose-base prose-emerald dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed 
                                            [&>ul]:space-y-1.5 [&>ol]:space-y-1.5 [&>p]:mb-3 [&>p:last-child]:mb-0
                                            [&>ul]:pl-4 [&>ol]:pl-4
                                            [&_strong]:text-gray-900 dark:[&_strong]:text-white font-medium
                                            [&_code]:bg-white dark:[&_code]:bg-gray-900 [&_code]:px-1.5 [&_code]:py-0.5 [&_code]:rounded-md [&_code]:text-[13px]">
                                            {!! str($chat['content'])->markdown() !!}
                                        </div>
                                    </div>
                                    
                                    {{-- AI Action buttons --}}
                                    <div class="flex items-center gap-2 mt-2 ml-1 h-6" x-show="showActions" x-transition.opacity.duration.200ms>
                                        <button @click="copyText(@js($chat['content']))" class="text-xs text-gray-400 hover:text-emerald-600 flex items-center gap-1 transition-colors" title="Salin">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                            Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- Typing Indicator --}}
                    <div wire:loading wire:target="sendMessage" class="flex gap-3 mb-4 w-full">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 overflow-hidden bg-emerald-50 dark:bg-gray-800 shadow-sm border border-emerald-100 dark:border-gray-700">
                            <img src="{{ asset('images/sorgummi logo.png') }}" class="w-5 h-5 object-contain" alt="AI">
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-800/80 border border-gray-100 dark:border-gray-700/50 px-5 py-4 rounded-2xl rounded-tl-sm shadow-sm inline-flex items-center h-[52px]">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 0ms; animation-duration: 1s"></span>
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 150ms; animation-duration: 1s"></span>
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce" style="animation-delay: 300ms; animation-duration: 1s"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Copied toast --}}
                    <div x-show="copied" x-transition.opacity class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-gray-800 text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
                        Berhasil disalin!
                    </div>
                </div>
            </main>

            {{-- Input Area (Bottom) --}}
            <div class="shrink-0 bg-white dark:bg-[#111c16] p-4 border-t border-gray-100 dark:border-gray-800 z-20">
                <form wire:submit.prevent="sendMessage()" class="relative flex items-center">
                    {{-- Input Field --}}
                    <div class="relative w-full flex items-center bg-gray-50 dark:bg-gray-800/60 rounded-full border border-gray-200 dark:border-gray-700 focus-within:border-emerald-400 dark:focus-within:border-emerald-500 transition-colors shadow-sm focus-within:shadow-md focus-within:shadow-emerald-500/10">
                        <input 
                            wire:model="message" 
                            type="text" 
                            placeholder="Ketik pesan..." 
                            class="flex-1 bg-transparent border-none focus:ring-0 text-[15px] text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 py-3.5 pl-6 pr-14 focus:outline-none w-full rounded-full" 
                            autocomplete="off"
                            id="chat-input"
                        >
                        
                        {{-- Send Button inside input --}}
                        <button 
                            type="submit" 
                            class="absolute right-2 w-10 h-10 rounded-full flex items-center justify-center text-white transition-all duration-200 shadow-md disabled:opacity-50 disabled:cursor-not-allowed hover:scale-105 active:scale-95" 
                            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"
                            wire:loading.attr="disabled"
                            wire:target="sendMessage"
                        >
                            <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4 translate-x-[-1px] translate-y-[1px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <svg wire:loading wire:target="sendMessage" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </button>
                    </div>
                </form>
                
                {{-- Footer Text --}}
                <div class="text-center mt-3">
                    <p class="text-[10px] text-gray-400 dark:text-gray-500">Sorgummi AI dapat membuat kesalahan. Harap verifikasi informasi penting.</p>
                </div>
            </div>
            
        </div>
    </div>
    
    <style>
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(10px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Custom scrollbar for Chat Area */
        #chat-container::-webkit-scrollbar { width: 5px; }
        #chat-container::-webkit-scrollbar-track { background: transparent; }
        #chat-container::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.08); border-radius: 999px; }
        .dark #chat-container::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); }
        #chat-container::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.15); }
        .dark #chat-container::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.15); }

        /* Prose improvements */
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        .prose li::marker { color: #10b981; }
    </style>

    {{-- Auto-scroll script --}}
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.updated', ({ el, component }) => {
                const container = document.getElementById('chat-container');
                if (container) {
                    requestAnimationFrame(() => {
                        container.scrollTo({
                            top: container.scrollHeight,
                            behavior: 'smooth'
                        });
                    });
                }
            });

            // Focus input on page load
            const input = document.getElementById('chat-input');
            if (input) input.focus();
        });
    </script>
</div>
