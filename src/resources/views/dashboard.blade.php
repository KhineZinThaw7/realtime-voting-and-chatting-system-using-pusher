<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>All Posts</h3>
                    <div class="row py-3">
                        <div class="col bg-primary p-2 text-white bg-opacity-75 border border-2">
                            News
                        </div>
                        <div class="col bg-primary p-2 text-white bg-opacity-75 border border-2">
                            Celebrities
                        </div>
                        <div class="col bg-primary p-2 text-white bg-opacity-75 border border-2">
                            Weather
                        </div>
                        <div class="col bg-primary p-2 text-white bg-opacity-75 border border-2">
                            Techonoly
                        </div>
                        <div class="col">
                           <button class="btn bg-primary text-white bg-opacity-75">Hello</button>
                        </div>
                    </div>
                    <div class="row py-3">
                        @foreach (App\Models\Post::all() as $post)
                            <div class="col-md-6">
                                <div class="card shadow-md">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <input type="hidden" class="post_id" value="{{ $post->id }}">
                                    <button class="btn btn-primary" onclick="postVoting({{ $post->id }})">Like <span class="badge bg-light text-dark" id="post_vote_count_{{ $post->id }}">{{ $post->vote }}</span></button>
                                    <button class="card-link">Another link</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('/js/vote.js') }}"></script>


