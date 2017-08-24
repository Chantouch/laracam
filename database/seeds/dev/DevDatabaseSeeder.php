<?php

use Illuminate\Database\Seeder;
use App\Model\Post;
use App\Model\User;
use App\Model\Comment;
use App\Model\NewsletterSubscription;
use Faker\Factory;

class DevDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Factory::create();

		factory(User::class, 10)
			->create()
			->each(function ($user) use ($faker) {
				factory(Post::class, $faker->numberBetween(2, 20))
					->create([
						'user_id' => $user->id
					])
					->each(function ($post) use ($faker) {
						factory(Comment::class, $faker->numberBetween(10, 60))
							->create([
								'post_id' => $post->id
							]);
					});
			});

		factory(NewsletterSubscription::class, $faker->numberBetween(10, 50))->create();
	}
}
