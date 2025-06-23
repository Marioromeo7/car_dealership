@props(['title'=>''])
<x-base-layout :$title>
@include('patials.header')
{{$slot}}
<footer></footer>
</x-base-layout>
