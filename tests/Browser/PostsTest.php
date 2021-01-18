<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Developer;
use App\Post;

class PostsTest extends DuskTestCase
{

    private $title = 'test title';
    private $edited_title = 'edited test';
    private $user_id = 14;
    private $meta_keywords = "integration, test";
    private $body = "body content";
    private $description = "CRUD tests";
    private $social_image_url = "https://pbs.twimg.com/profile_images/1156607111863918594/IIsMKisv_400x400.jpg";
    private $canonical_url = "https://www.graffino.com/posts/new";

        /** @test */
    public function createNewPost()
    {
        $this->browse(function (Browser $browser) {
             $browser->loginAs(Developer::find($this->user_id))
                    ->visit('/posts/new')
                    ->type('post_title', $this->title)
                    ->type('body', $this->body)
                    ->type('meta_keywords', $this->meta_keywords)
                    ->type('description', $this->description)
                    ->type('canonical_url', $this->canonical_url)
                    ->type('social_image_url', $this->social_image_url)
                    ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser->pause(200)
                    ->click('#submit-button')
                    ->pause(300);
            $this->assertDatabaseHas('posts', [
                'title' => $this->title
            ]);
        });
    }

    /** @test */
    public function editPost(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(Developer::find($this->user_id))
            ->visit('/')
            ->pause(100)
            ->clickLink($this->title)
            ->pause(100)
            ->clickLink('Edit')
            ->type('post_title', $this->edited_title)
            ->driver->executeScript('window.scrollTo(0, 500);');
            $browser->pause(200)
            ->click('#update-button')
            ->pause(200);
        });
        $this->assertDatabaseHas('posts', [
            'title' => $this->edited_title
        ]);
    }

    /** @test */
    public function deletePost(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(Developer::find($this->user_id))
            ->visit('/')
            ->pause(100)
            ->clickLink($this->edited_title)
            ->pause(100)
            ->clickLink('Edit')
            ->type('post_title', $this->edited_title)
            ->driver->executeScript('window.scrollTo(0, 500);');
            $browser->pause(200)
            ->click('#delete-button')
            ->pause(100);
        });
        $post = Post::where('title', '=', $this->edited_title)->get();
        $this->assertEmpty($post);
    }

}
