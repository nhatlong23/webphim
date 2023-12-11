<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Info;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testContactPage()
    {
        $info = Info::factory()->create([
            'title' => 'Liên hệ',
            'description' => 'Mô tả liên hệ',
            'contact' => 'Thông tin liên hệ',
            'terms_of_use' => 'Điều khoản sử dụng',
            'about_us' => 'Về chúng tôi',
            'privacy_policy' => 'Chính sách bảo mật',
            'copyright_claims' => 'test'
        ]);

        $response = $this->get('/post/lien-he');

        $response->assertStatus(200)
            ->assertSee('Thông tin liên hệ')
            ->assertSee('Liên hệ')
            ->assertSee('Mô tả liên hệ');
    }

    // public function testAboutUsPage()
    // {
    //     $info = Info::factory()->create([
    //         'title' => 'Liên hệ',
    //         'description' => 'Mô tả liên hệ',
    //         'contact' => 'Thông tin liên hệ',
    //         'terms_of_use' => 'Điều khoản sử dụng',
    //         'about_us' => 'Về chúng tôi',
    //         'privacy_policy' => 'Chính sách bảo mật',
    //         'copyright_claims' => 'test'
    //     ]);

    //     $response = $this->get('post/ve-chung-toi');

    //     $response->assertStatus(200)
    //         ->assertSee('Thông tin liên hệ')
    //         ->assertSee('Liên hệ')
    //         ->assertSee('Mô tả liên hệ');
    // }
}
