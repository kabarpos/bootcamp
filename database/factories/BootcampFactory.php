<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bootcamp>
 */
class BootcampFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static array $templates = [
        [
            'title' => 'Hacktiv8 Full Stack JavaScript',
            'mode' => 'hybrid',
            'level' => 'intermediate',
            'base_price' => 38500000,
            'duration_hours' => 640,
            'short_desc' => 'Program intensif 16 minggu yang fokus pada JavaScript modern, Node.js, dan React.',
            'syllabus_summary' => "Modul 1: Fundamental JavaScript.\nModul 2: React & Frontend.\nModul 3: Node.js & Back End.\nModul 4: Deploy & Career Support.",
        ],
        [
            'title' => 'Purwadhika Data Science & Machine Learning',
            'mode' => 'online',
            'level' => 'advanced',
            'base_price' => 42000000,
            'duration_hours' => 520,
            'short_desc' => 'Belajar analisis data, machine learning, dan deployment model dari mentor praktisi.',
            'syllabus_summary' => "Modul 1: Python & Statistik.\nModul 2: Exploratory Data Analysis.\nModul 3: Machine Learning.\nModul 4: Deep Learning & Deployment.",
        ],
        [
            'title' => 'Alterra Academy Backend Engineer',
            'mode' => 'offline',
            'level' => 'intermediate',
            'base_price' => 28500000,
            'duration_hours' => 360,
            'short_desc' => 'Pelatihan backend engineer dengan Java, Spring Boot, dan praktik microservices.',
            'syllabus_summary' => "Modul 1: Java & OOP.\nModul 2: Spring Boot.\nModul 3: Microservices & Testing.\nModul 4: Final Project.",
        ],
        [
            'title' => 'Binar Academy Product Management',
            'mode' => 'online',
            'level' => 'beginner',
            'base_price' => 9500000,
            'duration_hours' => 120,
            'short_desc' => 'Belajar pondasi product management dari discovery hingga delivery.',
            'syllabus_summary' => "Modul 1: Product Thinking.\nModul 2: Prioritization & Roadmap.\nModul 3: Metrics & Growth.\nModul 4: Pitching & Career Coaching.",
        ],
        [
            'title' => 'RevoU Digital Marketing Specialist',
            'mode' => 'online',
            'level' => 'beginner',
            'base_price' => 15500000,
            'duration_hours' => 200,
            'short_desc' => 'Program digital marketing end-to-end dengan fokus pada performance ads dan analytics.',
            'syllabus_summary' => "Modul 1: Digital Marketing Fundamentals.\nModul 2: Performance Ads.\nModul 3: Content & SEO.\nModul 4: Analytics & Growth Experiment.",
        ],
        [
            'title' => 'Skilvul UI/UX Designer Intensive',
            'mode' => 'hybrid',
            'level' => 'beginner',
            'base_price' => 7800000,
            'duration_hours' => 150,
            'short_desc' => 'Pelatihan UI/UX dari riset pengguna hingga prototyping di Figma.',
            'syllabus_summary' => "Modul 1: Design Thinking.\nModul 2: Wireframing.\nModul 3: Visual Design & Prototyping.\nModul 4: Usability Testing & Portfolio.",
        ],
    ];

    protected static int $sequence = 0;

    public function definition(): array
    {
        $template = static::$templates[static::$sequence % count(static::$templates)];
        static::$sequence++;

        return [
            'title' => $template['title'],
            'slug' => Str::slug($template['title']) . '-' . Str::random(3),
            'mode' => $template['mode'],
            'level' => $template['level'],
            'base_price' => $template['base_price'],
            'duration_hours' => $template['duration_hours'],
            'short_desc' => $template['short_desc'],
            'syllabus_summary' => $template['syllabus_summary'],
            'is_active' => true,
        ];
    }
}
