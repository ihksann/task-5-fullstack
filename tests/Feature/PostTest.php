<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase, WithoutMiddleware;
    public function test_membuat_artikel()
    {
        Storage::fake('image');

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

        $post = Post::create([
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('post.teststore', ['id' => 1]), [
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response->assertRedirect(route('post.testindex'));
    }



    public function test_menampilkan_artikel(){
        Storage::fake('image');

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

        $post = Post::create([
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('post.teststore', ['id' => 1]), [
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);


        $response = $this->get(route('post.testshow', $post->id));
        $response->assertOk();
    }


    public function test_mengupdate_artikel()
    {
        Storage::fake('image');

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

        $post = Post::create([
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);


        $data = [
            'title' => 'Mengupdate judul artikel',
            'content' => 'Mengupdate isi konten artikel',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('post.testupdate', $post->id), $data);
        $response->assertRedirect(route('post.testindex'));
    }


    public function test_menghapus_artikel()
    {

        Storage::fake('image');

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

        $post = Post::create([
            'title' => 'Membuat judul artikel baru',
            'content' => 'Berisi konten',
            'image' => UploadedFile::fake()->image('testing.jpg'),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response = $this->delete(route('post.testdelete', $post->id));
        $response->assertRedirect(route('post.testindex'));
    }

}
