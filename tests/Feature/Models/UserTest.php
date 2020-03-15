<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $faker = null;
    protected $model = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create('ja_JP');
    }

    /**
     * @test
     *
     * @return void
     */
    public function Create()
    {
        $this->model = \App\Models\User::create([
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->email(),
            'password' => bcrypt('1234'),
            'email_verified_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ]);
        $this->assertDatabaseHas($this->model->getTable(), [
            'email' => $this->model->email
        ]);
    }
}
