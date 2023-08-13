<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-main-layout>
    @if(isset($item))
        <x-posts.post-update :item="$item"></x-posts.post-update>
    @else
        <x-posts.post_create></x-posts.post_create>
    @endif
</x-main-layout>
</html>
