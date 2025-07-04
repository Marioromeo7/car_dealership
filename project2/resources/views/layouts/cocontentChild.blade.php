@props(['title'=>'','bodyClass'=>''])
<x-base-layout :$title :$bodyClass>
@include('patials.header')
{{$slot}}
<footer></footer>
</x-base-layout>
