<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountAttribute;
use App\Models\AccountGallery;
use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        Game::query()->truncate();
        Account::query()->truncate();
        AccountAttribute::query()->truncate();
        AccountGallery::query()->truncate();




        // Game
        // Liên Quân, PUBG, FreeFire
        $gameNames = ['Liên quân', 'PUBG', 'FreeFire'];
        foreach ($gameNames as $name) {
            Game::query()->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => '', 
                'accounts_count' => rand(1, 100) 
            ]);
        }


        // Account
        $existingSkus = [];
        for ($i = 0; $i < 10; $i++) {
            do {
                $sku = strtoupper(Str::random(2)) . str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (in_array($sku, $existingSkus)); 
            $existingSkus[] = $sku;

            $account = Account::query()->create([
                'game_id' => rand(1, 3),
                'sku' => $sku,
                'username' => fake()->text(10),
                'password' => fake()->password(8, 12),
                'image' => '',
                'price' => rand(100000, 200000),
            ]);

            if ($account->game_id == 1) {
                AccountAttribute::create([
                    'account_id' => $account->id,
                    'attribute_name' => 'Rank',
                    'attribute_value' => fake()->randomElement(['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond']) // Example ranks
                ]);
                AccountAttribute::create([
                    'account_id' => $account->id,
                    'attribute_name' => 'Skins',
                    'attribute_value' => rand(1, 10) // Random number of skins
                ]);
                AccountAttribute::create([
                    'account_id' => $account->id,
                    'attribute_name' => 'Heroes',
                    'attribute_value' => rand(1, 5) // Random number of heroes
                ]);
            }

            if ($account->game_id == 2) {
                AccountAttribute::create([
                    'account_id' => $account->id,
                    'attribute_name' => 'Rank',
                    'attribute_value' => fake()->randomElement(['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond']) // Example ranks
                ]);
            }

            if ($account->game_id == 3) {
                AccountAttribute::create([
                    'account_id' => $account->id,
                    'attribute_name' => 'Rank',
                    'attribute_value' => fake()->randomElement(['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond']) // Example ranks
                ]);
            }

        }
    }

}
