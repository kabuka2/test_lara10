<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-main-layout>
    @if(isset($item))
        <x-post-update :item="$item"></x-post-update>
    @else
        <x-post_create></x-post_create>
    @endif
</x-main-layout>
</html>
