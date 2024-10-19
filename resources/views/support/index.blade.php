@extends('layouts.app')
@section('content')
<div class="">
    <div class="">
        <div class="">
            <h2 class="text-2xl font-bold text-center mb-5 dark:text-white">Support Ticket System</h2>
            <p class="mb-10 text-center w-3/4 mx-auto dark:text-white">If you have any questions about the service or queries in general please open a ticket rather than sending an email.  This is allows me to manage all user requests quicker and in a more organised fashion.  Any existing tickets you have created along with their current status are shown below.  <span class="font-weight-bold">Please note that no email notifications are sent when tickets are responded to, a notification will be displayed in the top right of the site instead.</span></p>
            <div class="text-center">
                <a href="/support/create" class="border dark:border-gray-500 dark:text-white rounded p-2 bg-lime-500 dark:bg-lime-700 hover:bg-lime-400 shadow-lg">Create New Ticket</a>
            </div>
        </div>
    </div>       
    <div class="my-10">
        <table class="table-fixed text-center w-full shadow-lg">
            <thead class="">
                <tr class="border bg-gray-200 dark:bg-lime-700">
                    <th class="border w-2/3 p-2">Title</th>
                    <th class="border w-2/12 p-2">Created</th>
                    <th class="border w-2/12 p-2">Last reply by</th>
                    <th class="border w-2/12 p-2">Responded</th>
                    <th class="border w-2/12 p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td class="border p-2 text-indigo-500 hover:text-red-500"><a href="/support/{{ $ticket->id }}">{{ $ticket->title }}</a></td>
                        <td class="border p-2">{{ $ticket->created_at->diffForHumans() }}</td>
                        @if ($ticket->comments->last() != null)
                            <td class="border p-2">{{ $ticket->comments->last()->created_at->diffForHumans() }}</td>
                            <td class="border p-2">{{ $ticket->comments->last()->user->name }}</td>
                        @else
                            <td class="border p-2">---</td>
                            <td class="border p-2">---</td>
                        @endif					  	
                        <td class="border p-2">{{ $ticket->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class=""> {{ $tickets->links() }} </div>	
    </div>
</div>
@endsection