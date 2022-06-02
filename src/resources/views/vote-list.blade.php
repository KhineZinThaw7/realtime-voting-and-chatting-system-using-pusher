<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="noti-table">
                        <table class="table">
                            <tr>
                                <th>Voter Name</th>
                                <th>Voted Date</th>
                                <th>Read Status</th>
                            </tr>
                            @foreach ($notification as $noti)
                                <tr id="row-{{ $noti->id }}">
                                    <td>{{ $noti->data['voter_name'] }}</td>
                                    <td>{{ $noti->created_at }}</td>
                                    <td>
                                        <input type="hidden" value="{{ $noti->id }}" id="noti_id">
                                        <button class="btn btn-primary" id="read">Mark as Read</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('/js/vote.js') }}"></script>

