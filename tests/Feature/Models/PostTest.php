<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     * @return \App\Models\Post
     */
    public function Create()
    {
        $faker = \Faker\Factory::create('ja_JP');
        $model = \App\Models\Post::create([
            'title' => $faker->text(20),
            'body' => $faker->text(200),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);
        $this->assertDatabaseHas($model->getTable(), [
            'id' => $model->id,
            'title' => $model->title,
            'body' => $model->body,
        ]);

        return $model;
    }
}
