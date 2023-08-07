<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-main-layout>
    <x-comments.comments-list-table :dataProvider="$dataProvider"/>
</x-main-layout>
</html>
