<?php

class ShowPostTest extends FeatureTestCase
{
    function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'John Doe'
        ]);

        $post = $this->createPost([
            'title' => 'Como instalar Laravel',
            'content' => 'Este es el contenido de post',
            'user_id' => $user->id
        ]);

        // When
        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see('John Doe');
    }

    function test_old_urls_are_redirected()
    {
        // Having
        $post = $this->createPost([
            'title' => 'Old title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        // dd($url);
        $this->visit($url)
            ->seePageIs($post->url);
    }
}
