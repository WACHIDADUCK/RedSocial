<div>
    <br>
    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>    <span class="inline-block px-2 py-1 text-white text-sm font-semibold rounded"
        style="background-color: {{ $link->channel->color }}">
        {{ $link->channel->title }}
    </span>
    <li>{{$link->title}}</li>
    <p>{{$link->link}} 
        <span class="{{$link->approved ? 'text-green-500' : 'text-red-500'}}">
        {{$link->approved ? 'Aproved' : 'Not Aproved'}}</span></p>
</div>