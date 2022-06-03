<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chatting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" id="messenger">
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row py-3">
                        <label for="">To</label>
                        <select id="user_id" class="form-control">
                            <option>Select User</option>
                            @foreach (App\Models\User::where('id', '!=', Auth::id())->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row py-3">
                        <label for="">Subject</label>
                        <textarea id="message" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" onclick="sentMessage()">Sent</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('/js/vote.js') }}"></script>

