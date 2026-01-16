<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeedLargeData extends Command
{
    protected $signature = 'db:seed-large {--users=100}';
    protected $description = 'Seed users and addresses at scale without hitting placeholder limits';

    public function handle()
    {
        $userCount = (int) $this->option('users');
        $userChunkSize = 100;

        $this->info("Starting seed: $userCount users with $addressCount addresses each...");
        $bar = $this->output->createProgressBar($userCount);

        DB::connection()->disableQueryLog();

        for ($i = 0; $i < $userCount; $i += $userChunkSize) {
            DB::transaction(function () use ($userChunkSize, $addressCount, $bar) {
                $addressData = [];

                for ($j = 0; $j < $userChunkSize; $j++) {
                    $userId = DB::table('users')->insertGetId([
                        'name' => fake()->name(),
                        'email' => Str::random(10) . '_' . fake()->unique()->safeEmail(),
                        'password' => Hash::make('password'),
                        'phone' => fake()->phoneNumber(),
                        'gender' => fake()->randomElement(['male', 'female', 'other']),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    for ($k = 0; $k < $addressCount; $k++) {
                        $addressData[] = [
                            'user_id' => $userId,
                            'city' => fake()->city(),
                            'state' => fake()->state(),
                            'country' => fake()->country(),
                            'pincode' => fake()->postcode(),
                            'latitude' => fake()->latitude(),
                            'longitude' => fake()->longitude(),
                            'status' => ($k === 0) ? 'primary' : 'secondary',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        if (count($addressData) >= 5000) {
                            DB::table('addresses')->insert($addressData);
                            $addressData = [];
                        }
                    }
                    $bar->advance();
                }

                // Insert remaining addresses for this user chunk
                if (!empty($addressData)) {
                    DB::table('addresses')->insert($addressData);
                }
            });
        }

        $bar->finish();
        $this->newLine();
        $this->info('Seeding completed successfully!');
    }
}
