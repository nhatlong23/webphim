<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test case cho phương thức store (CREATE)
    public function testStoreCategory()
    {
        $response = $this->post(route('category.store'), [
            'title' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'This is a test category',
            'status' => 1,
        ]);

        $response->assertStatus(302); // Kiểm tra xem response có phải là chuyển hướng hay không
        $this->assertDatabaseHas('categories', ['title' => 'Test Category']); // Kiểm tra xem dữ liệu đã được thêm vào cơ sở dữ liệu chưa
    }

    // Test case cho phương thức update (UPDATE)
    public function testUpdateCategory()
    {
        // Tạo một thể loại category mới
        $category = Category::factory()->create();

        $response = $this->put(route('category.update', $category->id), [
            'title' => 'Updated Category',
            'slug' => 'updated-category',
            'description' => 'This is an updated category',
            'status' => 0,
        ]);

        $response->assertStatus(302); // Kiểm tra xem response có phải là chuyển hướng hay không
        $this->assertDatabaseHas('categories', ['title' => 'Updated Category']); // Kiểm tra xem dữ liệu đã được cập nhật trong cơ sở dữ liệu chưa
    }
}
