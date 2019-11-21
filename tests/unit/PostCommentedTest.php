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
        $post = new Post([
            'title' => 'Titulo del post'
        ]);

        $author = new User([
            'name' => 'John Doe'
        ]);

        $comment = new Comment;
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        // $this->assertInstanceOf(PostCommented::class, $notification);
        $subcriber = new User();

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
