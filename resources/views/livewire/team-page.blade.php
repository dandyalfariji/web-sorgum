<section class="bg-[#FFF8F3] dark:bg-[#0B221B]" id="team">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
        <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-[#0AA55A] dark:text-white">
                Tim Startup Sorgummi
            </h2>
            <p class="font-light text-gray-700 sm:text-xl dark:text-[#CBD5E1]">
                Para periset, inovator, dan builder di balik minuman sereal sorgum yang <i>happy & healthy</i>.
            </p>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 lg:gap-16">

            @forelse ($teamMembers as $member)
                <div class="text-center text-gray-600 dark:text-[#CBD5E1]">
                    <img class="mx-auto mb-4 w-36 h-36 rounded-full object-cover ring-1 ring-black/5 dark:ring-white/10"
                        src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }} - {{ $member->role }}">
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $member->name }}
                    </h3>
                    <p class="text-sm opacity-90">{{ $member->role }}</p>

                    @if ($member->instagram_url || $member->linkedin_url)
                        <ul class="flex justify-center mt-4 gap-4">
                            @if ($member->instagram_url)
                                <li>
                                    <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white dark:bg-gray-700 ring-1 ring-black/5 dark:ring-white/10 hover:opacity-90"
                                        aria-label="Instagram {{ $member->name }}">
                                        <svg viewBox="0 0 24 24" aria-label="Instagram" role="img" class="w-6 h-6 text-rose-600">
                                            <path fill="currentColor"
                                                d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7zm5 3.5A5.5 5.5 0 1112 18a5.5 5.5 0 010-11zm0 2A3.5 3.5 0 1015.5 13 3.5 3.5 0 0012 9.5zM18.5 6a1.25 1.25 0 11-1.25 1.25A1.25 1.25 0 0118.5 6z" />
                                        </svg>
                                    </a>
                                </li>
                            @endif

                            @if ($member->linkedin_url)
                                <li>
                                    <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white dark:bg-gray-700 ring-1 ring-black/5 dark:ring-white/10 hover:opacity-90"
                                        aria-label="LinkedIn {{ $member->name }}">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#0A66C2" aria-hidden="true">
                                            <path
                                                d="M4.98 3.5A2.5 2.5 0 1 0 5 8.5a2.5 2.5 0 0 0-.02-5ZM3 9h4v12H3zM9 9h3.8v1.9h.06c.53-1 1.83-2.06 3.77-2.06 4.03 0 4.77 2.65 4.77 6.1V21h-4v-4.9c0-1.17-.02-2.68-1.63-2.68-1.64 0-1.89 1.28-1.89 2.59V21H9z" />
                                        </svg>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                    <p>Saat ini belum ada anggota tim yang ditampilkan.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
