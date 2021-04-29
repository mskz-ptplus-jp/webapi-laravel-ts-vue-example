<?php

namespace Tests\Unit\Api\V1;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    static $endpoint = '/api/v1/users';

    /**
     * @test
     * @return \App\Models\User
     */
    public function Store()
    {
        $faker = \Faker\Factory::create('ja_JP');
        $model = new \App\Models\User();
        $model->name = $faker->unique()->userName();
        $model->email = $faker->unique()->email();
        $model->password = '1234';

        $response = $this->post(self::$endpoint, $model->toArray());
        $json = json_decode($response->getContent());

        $response = $this->post(self::$endpoint, $model->toArray());
        $json = json_decode($response->getContent());
        $response->assertStatus(200);

        $json = json_decode($response->getContent());
        $this->assertEquals(
            $model->email,
            $json[0]->email
        );

        return $model;
    }

    /**
     * @test
     * @depends Store
     * @return void
     */
    public function Update(\App\Models\User $model)
    {
        $faker = \Faker\Factory::create('ja_JP');
        $model->name = $faker->unique()->userName();

        $response = $this->post(
            implode("/", [self::$endpoint, $model->id]),
            $model->toArray()
        );
        $response->assertStatus(200);
        print_r(implode("/", [self::$endpoint, $model->id]));
        exit();

        $json = json_decode($response->getContent());
        $this->assertEquals(
            $model->name,
            $json[0]->name
        );
    }
}
