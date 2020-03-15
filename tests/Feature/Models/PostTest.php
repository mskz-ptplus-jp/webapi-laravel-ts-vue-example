<?php

namespace Tests\Feature\Models;

use Carbon\Carbon;
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

    /**
     * @test
     * @depends Create
     * @return \App\Models\Post
     */
    public function Update(\App\Models\Post $model)
    {
        $model->updated_at = new Carbon();
        $this->assertDatabaseHas($model->getTable(), [
            'id' => $model->id,
            'updated_at' => $model->updated_at
        ]);

        return $model;
    }

    /**
     * @test
     * @depends Update
     * @return void
     */
    public function Remove(\App\Models\Post $model)
    {
        $model->delete();
        $this->assertDatabaseMissing($model->getTable(), [
            'id' => $model->id,
        ]);
    }
}
