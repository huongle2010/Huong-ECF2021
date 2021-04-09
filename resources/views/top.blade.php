<x-layout>
  <x-slot name="title">
    top
  </x-slot>
  <h1> Top de animes </h1>
  <ul role="list" class="anime-list">
  @foreach($toplists as $toplist)
      <li class="flow">
        <div class="flow">
          <div>
          <img alt="" src="/covers/{{ $toplist->cover }}" />
          </div>

          <h2>
            {{ $toplist->title }}
          </h2>
          <h3>
            Rating : {{$toplist->ratings_average}}
          </h3>
        </div>
      </li>
        
      @endforeach
  </ul>
  </x-layout>