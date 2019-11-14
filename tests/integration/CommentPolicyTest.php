<?php

use App\User;
use App\Comment;
use App\Policies\CommnentPolicy;

class CommentPolicyTest extends FeatureTestCase
{
    function test_the_posts_author_can_select_a_comment_as_an_answer()
    {
        $comment = factory(Comment::class)->create();

        $policy = new CommnentPolicy;

        $this->assertTrue(
            $policy->accept($comment->post->user, $comment)
        );
    }

    function test_non_authors_cannot_select_a_comment_as_an_answer()
    {
        $comment = factory(Comment::class)->create();

        $policy = new CommnentPolicy;

        $this->assertFalse(
            $policy->accept(factory(User::class)->create(), $comment)
        );
    }
}
