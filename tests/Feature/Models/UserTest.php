<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $faker;
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create('ja_JP');
        $this->model = new \App\Models\User([
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->email(),
            'password' => bcrypt('1234'),
            'email_verified_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function Insert()
    {
        $model = \App\Models\User::create([
            'name' => $this->model->name,
            'email' => $this->model->email,
            'password' => $this->model->password,
            'email_verified_at' => $this->model->email_verified_at,
            'created_at' => $this->model->created_at,
            'updated_at' => $this->model->updated_at,
        ]);
        $this->assertDatabaseHas($this->model->getTable(), [
            'email' => $this->model->email
        ]);
    }
}
