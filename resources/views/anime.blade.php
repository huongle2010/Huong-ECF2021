<x-layout>
  <x-slot name="title">
    {{ $anime->title }}
  </x-slot>

  <article class="anime">
    <header class="anime--header">
      <div>
        <img alt="" src="/covers/{{ $anime->cover }}" />
      </div>
      <h1> {{ $anime->title }}</h1>
      <h3> Rating: {{ $avg_rating }} </h3>
    </header>
    <p>{{ $anime->description }}</p>
    <div>
      <div class="actions">
    @auth
        <div>
          <a class="cta" href="/anime/{{ $anime->id }}/new_review">Écrire une critique</a>
        </div>
       
        <form action="/anime/{{ $anime->id }}/add_to_watch_list" method="POST">
        @csrf
          <input type="hidden" value="{{$anime->id}}" name="animeid">
          <input type="hidden" value="{{ Auth::user()->id }}" name="userid">
          <button class="cta">Ajouter à ma watchlist</button>
          @error('error')
            <p class="error">{{ $message }}</p>
        @enderror
        </form>
       
        
    @endauth
      
    @guest
        <div>
          <a class="cta" href="/login">Écrire une critique</a>
        </div> 
        <form action="/login" method="GET">
          <button class="cta">Ajouter à ma watchlist</button>
        </form>
      @endguest
      </div>
      <h3>Reviews:</h3>
      <table>
      
            @foreach ($reviews as $review)
            <tr> 
              <td> 
              <strong>{{ $review->username }} </strong>:{{ $review->comment }}
              </td>
            </tr>
            @endforeach                                        
      </table>    
      
    </div>
  </article>
</x-layout>
