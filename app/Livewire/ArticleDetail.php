<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleDetail extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        if ($article->status !== 'Published') {
            abort(404);
        }
        $this->article = $article;
    }

    public function render()
    {
        $recentArticles = Article::where('status', 'Published')
            ->where('id', '!=', $this->article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Strip inline images to ensure only 1 image (the thumbnail) is shown
        $cleanContent = preg_replace('/<img[^>]*>/i', '', $this->article->content);
        $this->article->content = $cleanContent;

        // Smart TL;DR extraction: get h2, h3, and li text
        preg_match_all('/<(h2|h3|li)[^>]*>(.*?)<\/\1>/i', $cleanContent, $matches);
        $tldrPoints = array_filter(array_map(function($text) {
            return trim(strip_tags($text));
        }, $matches[2] ?? []));

        // If no bullet points found, fallback to first sentences of paragraphs
        if (empty($tldrPoints)) {
            preg_match_all('/<p[^>]*>(.*?)<\/p>/i', $cleanContent, $pMatches);
            foreach ($pMatches[1] ?? [] as $pText) {
                $sentences = explode('.', strip_tags($pText));
                if (!empty($sentences[0])) {
                    $tldrPoints[] = trim($sentences[0]) . '.';
                }
            }
            $tldrPoints = array_slice(array_filter($tldrPoints), 0, 5);
        }

        return view('livewire.article-detail', [
            'recentArticles' => $recentArticles,
            'tldrPoints' => array_values($tldrPoints)
        ]);
    }
}
