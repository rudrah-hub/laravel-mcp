<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeedLargeData extends Command
{
    protected $signature = 'db:seed-large {--users=100}';
    protected $description = 'Seed users at scale without hitting placeholder limits';

    public function handle()
    {
        $userCount = (int) $this->option('users');
        $userChunkSize = 100;

        $this->info("Starting seed: $userCount users each...");
        $bar = $this->output->createProgressBar($userCount);

        DB::connection()->disableQueryLog();

        for ($i = 0; $i < $userCount; $i += $userChunkSize) {
            DB::transaction(function () use ($userChunkSize, $addressCount, $bar) {
                $addressData = [];

                for ($j = 0; $j < $userChunkSize; $j++) {
                    $userId = DB::table('users')->insertGetId([
                        'name' => fake()->name(),
                        'email' => Str::random(10) . '_' . fake()->unique()->safeEmail(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $bar->advance();
                }
            });
        }

        $bar->finish();
        $this->newLine();
        $this->info('Seeding completed successfully!');
    }
}
