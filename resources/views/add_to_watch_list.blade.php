<x-layout>
  <x-slot name="title">
    My watchlist 
  </x-slot>
  <h1> Ma Watchlist </h1>
  <ul role="list" class="anime-list">
  @foreach($mywatchlists as $mywatchlist)
      <li class="flow">
        <div class="flow">
          <div>
          <img alt="" src="/covers/{{ $mywatchlist->cover }}" />
          </div>

          <h2>
            {{ $mywatchlist->title }}
          </h2>
        </div>
        <a class="cta" href="/anime/{{ $mywatchlist->animeID }}">Voir</a>
      </li>
  @endforeach
  </ul>


</x-layout>
