<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <x-main-layout>

        <div class="posts-block">
            @auth
                <a class = "create_post" href="{{route('posts.create')}}">
                    Create Post
                </a>
            @endauth

            <x-posts.post-search/>

            @foreach($data['posts'] as $key)

                <x-posts.main-page-comments-block
                    :user_name="$key->users[0]->name"
                    :created_at="$key->created_at"
                    :name="$key->name"
                    :post_image="$key->image"
                    :body="$key->body"
                    :id="$key->id"
                    :count="$key->count_comments"
                />
            @endforeach

        </div>
    </x-main-layout>
</html>
