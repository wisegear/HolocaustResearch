@extends('layouts.admin')

@section('content')

<div class="w-1/2 mx-auto text-center mb-10">
	<h1 class="text-2xl font-bold">Dashboard</h1>
	<p class="text-gray-500">Admin Dashboard. From here you can manage the Users, Blog, Articles, Support tickets and other elements as required.</p>
</div>

<div class="grid grid-cols-4 gap-20">

	<div class="border bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Users <span class="text-blue-700 text-center">{{ $users->count() }}</span></h2>		
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Banned: <span class="">{{ $users_banned }}</span></p>
			<p class="">Pending: <span class="">{{ $users_pending }}</span></p>
			<p class="">Members: <span class="">{{ $users_active }}</span></p>
            <p class="">Admin: <span class="">{{ $users_admin }}</span></p>
		</div>
	</div>

	<div class="border bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Blog Posts <span class="text-blue-700 text-center">{{ $blogposts->count() }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Not published: <span class=""></span>{{ $blogunpublished->count() }}</p>
		</div>
	</div>

	<div class="border bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Links <span class="text-blue-700 text-center">{{ $links->count() }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Not published: <span class=""></span>{{ $linksunpublished->count() }}</p>
		</div>
	</div>

	<div class="bborder bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Support <span class="text-blue-700 text-center">{{ $tickets->count() }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">In Progress:  <span class="">{{ $in_progress_tickets }}</span></p>
			<p class="">Awaiting Reply:  <span class="">{{ $awaiting_reply }}</span></p>
			<p class="">Open:  <span class="">{{ $open_tickets }}</span></p>
		</div>
	</div>

	<div class="bborder bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Timeline <span class="text-blue-700 text-center">{{ $timeline }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Not Published:  <span class="">{{ $timelineunpublished }}</span></p>
		</div>
	</div>

	<div class="bborder bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Gallery <span class="text-blue-700 text-center">{{ $gallery }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Not Published:  <span class="">{{ $gallerynp }}</span></p>
		</div>
	</div>

	<div class="bborder bg-gray-100 rounded p-4 shadow-lg">
		<div class="border-b border-b-gray-400">
			<h2 class="text-xl font-bold text-center pb-2">Quotes <span class="text-blue-700 text-center">{{ $quotes }}</span></h2>
		</div>
		<div class="mt-5 text-center text-sm text-gray-500">
			<p class="">Not Published:  <span class="">{{ $quotesnp }}</span></p>
		</div>
	</div>

</div>
 
@endsection