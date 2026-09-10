<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where('status', 'Published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('livewire.article-index', [
            'articles' => $articles,
        ]);
    }
}
