<?php

class ShowPostTest extends FeatureTestCase
{
    function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'John Doe'
        ]);

        $post = factory(\App\Post::class)->make([
            'title' => 'Como instalar Laravel',
            'content' => 'Este es el contenido de post'
        ]);

        $user->posts()->save($post);
        // dd($post->url);

        // When
        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);
    }

    function test_old_urls_are_redirected()
    {
        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'Old title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        // dd($url);
        $this->visit($url)
            ->seePageIs($post->url);
    }
}
