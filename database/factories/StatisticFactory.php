<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           return [
            'index' => 0,
            'channel' => 0,
            'post' => 0,
            'cabinet' => 0,
            'site' => 0,
            'complaints' => 0,
            'admin' => 0,
            'bot_start' => 0,
            'bot_post' => 0,
            'bot_1' => 0,
            'bot_2' => 0,
            'bot_3' => 0,
            'smart' => 0,
            'pc' => 0,
            'ad' => 0,
            'num' => 0,
        ];
    }
}
