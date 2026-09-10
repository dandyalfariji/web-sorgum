<div class="bg-[#FFF8F3] dark:bg-[#0B221B] min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white dark:bg-[#0f2f25] rounded-xl shadow-md overflow-hidden flex flex-col hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('article.detail', $article->slug) }}" wire:navigate>
                        <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://placehold.co/600x400/0AA55A/ffffff?text=Sorgum+Artikel' }}" alt="{{ $article->title }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : '' }}
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            <a href="{{ route('article.detail', $article->slug) }}" wire:navigate class="hover:text-[#0AA55A] transition-colors">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3 text-sm">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('article.detail', $article->slug) }}" wire:navigate class="text-[#0AA55A] hover:text-[#E31067] font-medium transition-colors inline-flex items-center text-sm">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 dark:text-gray-400">
                    <div class="inline-block p-6 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-500 dark:text-gray-400">Nantikan informasi edukatif seputar sorgum yang akan segera hadir.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>
    </div>
</div>
