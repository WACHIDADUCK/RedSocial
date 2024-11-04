<div>
    <br>
    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}
        </small>
        <a href="/dashboard/{{ $link->channel->slug }}"><span class="inline-block px-2 py-1 text-white text-sm font-semibold rounded"
        style="background-color: {{ $link->channel->color }}">
        {{ $link->channel->title }}
    </span></a>
    <li>{{$link->title}} </li>

    <form method="POST" action="/votes/{{ $link->id }}">

        @csrf
        
        <button type="submit"
        
        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 disabled:opacity-50 
        {{ Auth::check() && Auth::user()->votedFor($link) ?

            'bg-green-500 hover:bg-green-600 text-white' :
            'bg-gray-500 hover:bg-gray-600 text-white'
        }}
        "
        
        {{ !Auth::user()->isTrusted() ? 'disabled' : '' }}>
        
        {{ $link->users()->count() }}
        
        </button>
        
        </form>
        
    
        <p>{{$link->link}} 
        <span class="{{$link->approved ? 'text-green-500' : 'text-red-500'}}">
        {{$link->approved ? 'Aproved' : 'Not Aproved'}}</span> 
            {{-- <span class="text-blue-500 text-xl">👍  {{ $link->users()->count() }}</span> --}}
        </p>
</div>