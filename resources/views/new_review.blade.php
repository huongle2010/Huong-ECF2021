<x-layout>
  <x-slot name="title">
    Nouvelle critique de [nom de l'anime]
  </x-slot>
  <div class="review">
    <div>
        <h1>Nouvelle Critique de {{$anime -> title}} </h1>
  
     @if($checkReviews)
            <h3> Vous avez déja ajouté un critique </h3>

     @else
        <form method="POST" action='/anime/{id}/new_review'>
                @csrf    
            <div class="input-group">              
                <label for="critique">Ecrire une critique</label>          
                <textarea id="critique" name="comment"></textarea>                 
            </div>
            @error('comment')
            <p class="error">{{ $message }}</p>
            @enderror
            <div class="input-group">              
                <label for="note">Donner une note à l’anime (entre 0 et 10)</label>          
                <input type="number" id="note" name="rating" min="0" max="10"/>                   
            </div>
            @error('rating')
            <p class="error">{{ $message }}</p>
            @enderror
            @auth
            <input type="hidden" value="{{ Auth::user()->id }}" name="userID">
            @endauth
            <input type="hidden" value="{{ $anime -> id }}" name="animeID">
            <button class="cta">Ajouter</button>   
        </form> 
    @endif

    </div>
  </div>
  

</x-layout>