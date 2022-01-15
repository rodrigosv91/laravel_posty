@extends('layouts.app')

@section('content')
   <div class="flex justify-center">    
        <div class="w-8/12">
            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post ) 
                        <x-post :post="$post" />
                    @endforeach
                    {{ $posts->links('pagination::semantic-ui') }}                    
                @else
                    <p>There are no results</p>
                @endif  
            </div>
        </div>
   </div>
@endsection