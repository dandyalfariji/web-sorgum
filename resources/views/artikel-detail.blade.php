<x-layouts.app :title="$article->title . ' | Artikel Edukasi'">
    <livewire:header-page />

    <livewire:article-detail :article="$article" />

    <livewire:footer-page />
</x-layouts.app>
