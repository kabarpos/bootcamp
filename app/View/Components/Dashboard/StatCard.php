<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string $subtitle,
        public string $value,
        public string $gradient = 'from-blue-500 to-blue-600',
        public string $icon = ''
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.stat-card');
    }
}
