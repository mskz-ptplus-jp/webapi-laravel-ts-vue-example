<?php

namespace Tests\Unit\Api\V1;

use Tests\TestCase;

class UserControllerTest extends TestCase
{

    static $endpoint = '/api/v1/users';

    /**
     * @test
     *
     * @return void
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

        $response->assertStatus(200);
        $this->assertEquals(
            $model->email,
            $json[0]->email
        );
    }
}
