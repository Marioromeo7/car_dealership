@props(['color'=>"red","bgcolor"=>"white"])
<div class="card card-text-{{$color}} card-bg-{{$bgcolor}}">
    <div class="card-header">{{$title}}</div>
    {{$slot}}
    <div class="card-footer">{{$footer}}</div>
</div>
