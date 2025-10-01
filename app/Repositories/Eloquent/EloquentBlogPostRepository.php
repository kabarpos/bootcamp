<?php

namespace App\Repositories\Eloquent;

use App\Models\BlogPost;
use App\Repositories\Contracts\BlogPostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentBlogPostRepository implements BlogPostRepositoryInterface
{
    public function __construct(private readonly BlogPost $model)
    {
    }

    public function getPublished(int $limit = 3, array $relations = []): Collection
    {
        return $this->model->with($relations)
            ->published()
            ->latest()
            ->take($limit)
            ->get();
    }
}
