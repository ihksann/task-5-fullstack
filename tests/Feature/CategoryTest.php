<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Http\Controllers\Admin\CategoryController;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase, WithoutMiddleware;
    public function test_membuat_kategori()
    {
        $this->withoutExceptionHandling();

        $user = User::create([
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('testing123'),
        ]);

        $auth = Auth::login($user);
        
        Category::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);


        $response = $this->post(route('category.teststore', ['category_id' => 1]), [
            'name' => 'test',
            'user_id' => $user->id,
        ]);
        $response->assertRedirect(route('category.testindex'));
    }


    public function test_menampilkan_kategori()
    {
        $this->withoutExceptionHandling();

        $user = User::create([
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('testing123'),
        ]);

        $auth = Auth::login($user);

        $category = Category::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);


        $response = $this->get(route('category.testshow', ['category_id' => $category->id]));
        $response->assertOk();
    }

    public function test_mengupdate_kategori()
    {
        $this->withoutExceptionHandling();

        $user = User::create([
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('testing123'),
        ]);

        $auth = Auth::login($user);

        $category = Category::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);

        $data = [
            'name' => 'testing update',
            'user_id' => $user->id,
        ];

        $response = $this->put(route('category.testupdate', ['category_id' => $category->id]), $data);
        $response->assertRedirect(route('category.testindex'));
    }

    public function test_menghapus_kategori()
    {
        $this->withoutExceptionHandling();

        $user = User::create([
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('testing123'),
        ]);

        $auth = Auth::login($user);

        $category = Category::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);

        $response = $this->delete(route('category.testdelete', ['category_id' => $category->id]));
        $response->assertRedirect(route('category.testindex'));
    }
}
