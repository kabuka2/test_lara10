<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-main-layout>
    <x-comments-list-table :dataProvider="$dataProvider"></x-comments-list-table>
</x-main-layout>
</html>
