<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $faker = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create('ja_JP');
    }

    /**
     * @test
     * @return \App\Models\User
     */
    public function Create()
    {
        $model = \App\Models\User::create([
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->email(),
            'password' => bcrypt('1234'),
            'email_verified_at' => $this->faker->dateTime(),
        ]);
        $this->assertDatabaseHas($model->getTable(), [
            'email' => $model->email
        ]);

        return $model;
    }

    /**
     * @test
     * @depends Create
     * @return \App\Models\User
     */
    public function Update(\App\Models\User $model)
    {
        $model->name = $this->faker->unique()->userName();
        $model->update();
        $this->assertDatabaseHas($model->getTable(), [
            'email' => $model->email,
            'name' => $model->name
        ]);

        return $model;
    }

    /**
     * @test
     * @depends Update
     * @return void
     */
    public function Remove(\App\Models\User $model)
    {
        $model->delete();
        $this->assertDatabaseMissing($model->getTable(), [
            'email' => $model->email,
        ]);
    }
}
