<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LinkTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateLink() {


        $user = factory('App\Models\User')->create();

        $this->actingAs($user)->post('/api/links', [
                'private' => false,
                'url'     => 'https://scotch.io/tutorials/handling-authentication-in-vue-using-vuex']
        );

        $this->assertEquals(
            201, $this->response->getStatusCode()
        );
    }

    public function testDeleteLinkUnauthorized() {

        $code = 'test-code';

        $link = factory('App\Models\Link')->create([
            'code' => $code,
        ]);

        $user = factory('App\Models\User')->create();

        $this->actingAs($user)->delete("/api/links/{$code}");

        $this->assertEquals(
            401, $this->response->getStatusCode()
        );
    }

    public function testDeleteLinkAuthorized() {

        $code = 'test-code-2';

        $user = factory('App\Models\User')->create();

        $link = factory('App\Models\Link')->create([
            'code' => $code,
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->delete("/api/links/{$code}");

        $this->assertEquals(
            200, $this->response->getStatusCode()
        );
    }
}
