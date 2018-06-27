<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ArticleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testsArticlesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->createToken('WAI')->accessToken;
        $headers = ['Authorization' => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEzZmE5NmNjMzQ4NDEzYTg2YzU1ZjM5YzRiMzJjMTUwNGJiM2ZkODViNDQ2YTA3NTg5NGYwMTYzNjc2NzEyNTIzYmI1ZmE1MmQxZDJjOTczIn0.eyJhdWQiOiIxIiwianRpIjoiMTNmYTk2Y2MzNDg0MTNhODZjNTVmMzljNGIzMmMxNTA0YmIzZmQ4NWI0NDZhMDc1ODk0ZjAxNjM2NzY3MTI1MjNiYjVmYTUyZDFkMmM5NzMiLCJpYXQiOjE1MjU1NDU5MjUsIm5iZiI6MTUyNTU0NTkyNSwiZXhwIjoxNTU3MDgxOTI1LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.KBje1RFQFsGVyY-35NznpzdExzLx3CZ1uI9P9FTmXfUDoT8P1VrzTt-dtJlyVehdV_b9Tqj7a1AF-wMZBNoGfLeesp6lI1dftB3nY6Uk5D-jxfzRO8RQWZwGOwB3vwXYC7tKAXep_nj-XMkJiQuJ2g-bXC60tjjSHaU4krWNHPzLFbgcqI3yBRfgpyvO8wwVvynFkeuyyZbg3l5VRSTBucTUBs5jIAkFawYGKJpQ104uwfS23Ee2VAASmWi-fwcbE2fVHh1RwWbdcz6h0jzAolr8KvxmlWBYmJf0HsnIeBcmnMXmWvKU7yOAVjpdSJaFBX5Sadbi4zcecbDLm_Ns0i4Lpy5zgtVd4iTcJyjFsn0EeUyeoc5zDLIodQuYfHBzsYhaOWYUdsKUqUHwVzeUHtP0IHhlpYgWaT1a652PIFMFivwI3UqHoVCxliEXJz0XvHo9xoellUpnIk8kSyJaevxkfIbUx1PhLHjMP27ZXtUSbZrk1YF_2CjOdXXJQ8QgxYBviP7Ui0DaiwPSJe3iYDSRTyRIzmMa9Kj0p-TSWYMeuTm8Q-hLLLKN1ZvFVrS-SLgNcq1sgPJyiq7aEt_6mZtN43_8KZhUPcTFED0-0QcXbXFVhELvvgcoWfij3xCz7wDV23Jq1NqMbqdAXakvwy1NfVPeH6-QTkg3u6XLuRA"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $this->json('POST', '/api/articles', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }
}
