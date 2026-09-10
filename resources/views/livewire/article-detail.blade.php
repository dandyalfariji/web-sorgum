<div class="bg-[#FFF8F3] dark:bg-[#0B221B] min-h-screen py-12" 
     x-data="{ showTldr: false, scrollPercent: 0 }" 
     @scroll.window="scrollPercent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100">
    
    <!-- Reading progress bar fixed top -->
    <div class="fixed top-0 left-0 w-full h-1 z-50 bg-transparent">
        <div class="h-full bg-[#0AA55A] transition-all duration-75" :style="'width: ' + scrollPercent + '%'"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <a href="{{ route('article.index') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-[#0AA55A] hover:text-[#E31067] mb-8 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Artikel
        </a>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left Column: Article Content (Span 8) -->
            <div class="lg:col-span-8">
                
                <!-- Title -->
                <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                <!-- Meta Row -->
                <div class="flex flex-wrap items-center text-sm text-gray-600 dark:text-gray-400 mb-8 gap-y-4">
                    <!-- Author -->
                    <div class="flex items-center mr-6">
                        <img src="{{ asset('images/sorgummi logo.png') }}" alt="Sorgumology Team" class="w-8 h-8 rounded-full mr-2 object-cover bg-white p-1 shadow-sm border border-gray-200">
                        <span class="font-medium text-gray-900 dark:text-gray-200">Tim Sorgumology</span>
                    </div>
                    
                    <!-- Category Badge -->
                    <div class="mr-6 px-3 py-1 bg-gray-200 dark:bg-[#0f2f25] text-gray-700 dark:text-gray-300 rounded-full font-medium text-xs">
                        Edukasi
                    </div>

                    <!-- Read Time -->
                    <div class="flex items-center mr-6">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        5 min read
                    </div>

                    <!-- Date -->
                    <div class="flex items-center mr-auto">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $article->published_at ? $article->published_at->format('d M Y') : 'Draft' }}
                    </div>
                </div>

                <!-- TL;DR Toggle -->
                <div class="flex items-center justify-between p-4 mb-6 rounded-2xl bg-white dark:bg-[#0f2f25] border border-gray-100 dark:border-gray-800 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-xl bg-green-50 dark:bg-green-950/30 text-[#0AA55A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white text-sm">Mode TLDR (Ringkasan Poin)</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Aktifkan untuk membaca versi ringkas dari artikel ini.</p>
                        </div>
                    </div>
                    <button @click="showTldr = !showTldr" 
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                            :class="showTldr ? 'bg-[#0AA55A]' : 'bg-gray-200 dark:bg-gray-700'">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                              :class="showTldr ? 'translate-x-5' : 'translate-x-0'"></span>
                    </button>
                </div>

                <!-- Thumbnail (Single Image) -->
                @if($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-3xl shadow-lg mb-10">
                @endif

                <!-- Article Prose Content -->
                <div x-show="!showTldr" 
                     class="max-w-none text-gray-700 dark:text-gray-300 leading-relaxed text-base
                            [&>h2]:text-xl [&>h2]:font-bold [&>h2]:text-gray-900 [&>h2]:dark:text-white [&>h2]:mt-10 [&>h2]:mb-4
                            [&>h3]:text-lg [&>h3]:font-semibold [&>h3]:text-gray-900 [&>h3]:dark:text-white [&>h3]:mt-8 [&>h3]:mb-3
                            [&>p]:mb-5
                            [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:mb-5 [&>ul]:space-y-2
                            [&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:mb-5 [&>ol]:space-y-2
                            [&_strong]:text-gray-900 [&_strong]:dark:text-white [&_strong]:font-bold
                            [&_em]:italic">
                    {!! $article->content !!}
                </div>

                <!-- TL;DR bullet points -->
                <div x-show="showTldr" x-cloak
                     class="p-6 rounded-2xl bg-white dark:bg-[#0f2f25] border border-gray-100 dark:border-gray-800 shadow-sm space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0AA55A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Ringkasan Artikel (Poin Penting)
                    </h3>
                    <ul class="list-disc pl-6 space-y-3 text-gray-700 dark:text-gray-300 text-base">
                        @foreach($tldrPoints as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Right Column: Sidebar (Span 4) -->
            <div class="lg:col-span-4 lg:pl-8 space-y-12 mt-12 lg:mt-0">
                
                <!-- Reading Scroll Animation Progress Tracker -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#0f2f25] border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col items-center justify-center text-center">
                    <div class="relative w-24 h-24 mb-4 flex items-center justify-center">
                        <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                            <circle class="text-gray-100 dark:text-gray-800" stroke-width="6" stroke="currentColor" fill="transparent" r="40" cx="48" cy="48" />
                            <circle class="text-[#0AA55A]" stroke-width="6" :stroke-dasharray="2 * Math.PI * 40" :stroke-dashoffset="2 * Math.PI * 40 * (1 - scrollPercent / 100)" stroke-linecap="round" stroke="currentColor" fill="transparent" r="40" cx="48" cy="48" />
                        </svg>
                        <div class="text-[#0AA55A] transition-transform duration-75" :style="'transform: rotate(' + (scrollPercent * 3.6) + 'deg)'">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 8C17 11.5 14.5 15 12 17.5C9.5 15 7 11.5 7 8C7 5 9.5 3 12 3C14.5 3 17 5 17 8Z" />
                                <path d="M12 21C12 21 8 18.5 8 16.5H16C16 18.5 12 21 12 21Z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Progress Membaca</span>
                    <span class="text-lg font-extrabold text-gray-900 dark:text-white mt-1" x-text="Math.round(scrollPercent) + '%'">0%</span>
                </div>

                <!-- Tags Section -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-5">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-4 py-2 bg-white dark:bg-[#0f2f25] border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:border-[#0AA55A] hover:text-[#0AA55A] cursor-pointer transition-colors">Sorgum Sehat</span>
                        <span class="px-4 py-2 bg-white dark:bg-[#0f2f25] border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:border-[#0AA55A] hover:text-[#0AA55A] cursor-pointer transition-colors">Diet & Nutrisi</span>
                        <span class="px-4 py-2 bg-white dark:bg-[#0f2f25] border border-gray-200 dark:border-gray-700 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:border-[#0AA55A] hover:text-[#0AA55A] cursor-pointer transition-colors">Gaya Hidup</span>
                    </div>
                </div>

                <!-- Related Blogs Section -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-5">Related Blogs</h4>
                    <div class="space-y-4">
                        @if(isset($recentArticles) && $recentArticles->count() > 0)
                            @foreach($recentArticles as $recent)
                            <a href="{{ route('article.detail', $recent->slug) }}" wire:navigate class="group flex items-start gap-4 p-3 -mx-3 rounded-xl hover:bg-white dark:hover:bg-[#0f2f25] hover:shadow-sm transition-all duration-200 border border-transparent hover:border-gray-100 dark:hover:border-gray-800">
                                <!-- Small Thumbnail -->
                                <div class="flex-shrink-0 w-28 h-20 rounded-lg overflow-hidden relative shadow-sm">
                                    <img src="{{ $recent->thumbnail ? asset('storage/' . $recent->thumbnail) : 'https://placehold.co/600x400/0AA55A/ffffff?text=Sorgum+Artikel' }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <!-- Content -->
                                <div class="flex-1 min-w-0 py-1">
                                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 font-medium">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $recent->published_at ? $recent->published_at->format('d M Y') : 'Draft' }}
                                    </div>
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-[#0AA55A] transition-colors line-clamp-2 leading-snug">
                                        {{ $recent->title }}
                                    </h5>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <div class="text-sm text-gray-500 dark:text-gray-400 p-4 bg-white dark:bg-[#0f2f25] rounded-xl border border-gray-100 dark:border-gray-800 text-center">Belum ada artikel terkait.</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
