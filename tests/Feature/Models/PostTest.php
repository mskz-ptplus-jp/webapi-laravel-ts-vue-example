<?php

namespace Tests\Feature\Models;

use Carbon\Carbon;
use Tests\TestCase;

class PostTest extends TestCase
{
    protected $faker = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create('ja_JP');
    }

    /**
     * @test
     * @return \App\Models\Post
     */
    public function Create()
    {
        $model = \App\Models\Post::create([
            'title' => $this->faker->text(20),
            'body' => $this->faker->text(200),
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
        $model->title = $this->faker->text(20);
        $model->save();
        $this->assertDatabaseHas($model->getTable(), [
            'id' => $model->id,
            'title' => $model->title
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
