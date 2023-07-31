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
                <div class="posts-block-body">
                    <p>{{ $post->body }}</p>
                    <button class="expand-btn">Read more</button>
                </div>
                <div class="post-comments">
                    @if(count($post->comments) > 0)
                        <ul>
                            @foreach($post->comments as $comment)
                                @include('components.comments', ['comment' => $comment])
                            @endforeach
                        </ul>
                    @else
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div>

        </div>




    </x-main-layout>
</html>
