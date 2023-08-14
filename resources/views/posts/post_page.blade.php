<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <x-main-layout>
        <div class="posts-block">
            <div class="posts-block-post">
                <div class="story__header">
                    <div class="story__user user">
                        <span>{{$post->user->name}}</span>
                        <span>{{$post->created_at}}</span>
                    </div>
                    <h2 class="posts-block-post-name">
                        {{ $post->name }}
                    </h2>
                </div>
                @if(!empty($post->image))
                    <div class = "posts-block-image">
                        <img class="fit-picture" src="{{$post->image}}" alt="post_image">
                    </div>
                @endif
                <div class="posts-block-body">
                    <p>{{$post->body}}</p>
                    <button class="expand-btn">Read more</button>
                </div>
                <div class="post-comments">
                    <x-comments.ui.add-comment-block :parent_id="0" :post_id="$post->id"/>
                    @if(count($post->comments) > 0)
                        <ul>
                            @foreach($post->comments as $comment)
                                <x-comments.comments :comment="$comment"></x-comments.comments>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </x-main-layout>
</html>
