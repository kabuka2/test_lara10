<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-main-layout>
    @include('components.posts.post_list_table', ['dataProvider' => $dataProvider])
</x-main-layout>
</html>
