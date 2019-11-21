<?php

use App\Post;
use App\User;
use App\Comment;
use App\Notifications\PostCommented;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends FeatureTestCase
{
    function test_it_builds_a_mail_message()
    {
        $post = factory(Post::class)->create([
            'title' => 'Titulo del post'
        ]);

        $author = factory(User::class)->create([
            'name' => 'John Doe'
        ]);

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'user_id' => $author->id
        ]);

        $notification = new PostCommented($comment);

        // $this->assertInstanceOf(PostCommented::class, $notification);
        $subcriber = factory(User::class)->create();

        $message = $notification->toMail($subcriber);

        $this->assertInstanceOf(MailMessage::class, $message);
        // dd($message);
        $this->assertSame(
            'Nuevo comentario en: Titulo del post',
            $message->subject
        );
        $this->assertSame(
            'John Doe escribió un comentario en: Titulo del post',
            $message->introLines[0]
        );
        $this->assertSame(
            $comment->post->url,
            $message->actionUrl
        );
    }
}
