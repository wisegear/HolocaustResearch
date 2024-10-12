@extends('layouts.app')

@section('content')

    <!-- Post Header Section -->
    <div class="">    
        <h1 class="text-4xl font-bold text-center dark:text-white">{{$post->title}}</h1>
            <ul class="flex flex-col md:flex-row items-center md:justify-center md:space-y-0 md:space-x-10 space-y-2 my-4">
                <li><a href="/profile/{{ $post->users->name_slug }}" class="text-gray-700 dark:text-gray-400 hover:text-sky-700"><i class="fa-solid fa-user mr-2"></i>{{ $post->users->name }}</a></li>
                <li class="text-gray-700 dark:text-gray-400"><i class="fa-solid fa-calendar-days mr-2"></i>{{ $post->created_at->diffForHumans() }}</li>
                <li><a href="/blog?category={{ $post->blogcategories->name }}" class="text-gray-700 dark:text-gray-400 hover:text-sky-700"><i class="fa-solid fa-folder mr-2"></i>{{ $post->blogcategories->name }}</a></li>
            </ul>    
        <p class="text-center md:w-1/2 mx-auto text-gray-500 dark:text-gray-300">{{$post->excerpt }}</p>
            <div class="flex space-x-4 my-6 justify-center">
                @foreach ($post->blogtags as $tag)
                    <a href="/blog?tag={{ $tag->name }}" class="p-1 text-xs uppercase border dark:border-gray-700 rounded font-bold bg-slate-600 text-white hover:bg-slate-400 hover:text-white">{{ $tag->name }}</a>
                @endforeach
            </div>

            <img src="{{ asset($post->large_image) }}" class="w-full h-[400px] shadow-lg border dark:border-gray-700 rounded" alt="">
    </div>

    <!-- Wrapper around post to split into post and sidebar -->

    <div class="flex space-x-10">
        <!-- Wrapper for the post content -->
        <div class="w-full">
            <!-- Table of contents -->
            <div class="w-full md:w-2/3 lg:w-1/3 mx-auto">
                @if(count($post->getBodyHeadings('h2')) > 2)
                    <div class="toc my-10">
                        <h2 id="toc-title" class="mb-2 border-b border-gray-300 cursor-pointer">
                            <i class="fa-solid fa-arrow-down-short-wide text-blue-600"></i> Table of contents
                            <span id="toc-arrow" class="ml-2 transform transition-transform duration-200"></span>
                        </h2>
                        <ul id="toc-list" class="space-y-2 hidden">
                            @foreach($post->getBodyHeadings('h2') as $heading)
                                <li><a href="#{{ Str::slug($heading) }}" class="hover:text-blue-700">{{ $heading }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Post text, separate from other content.  We do this as wise1text is used for formatting -->

            <div class="wise1text mt-10">
                {!! $post->addAnchorLinkstoHeadings() !!}
            </div>


            <!-- Author Box -->

            <div class="flex flex-col md:flex-row items-center rounded shadow-lg border bg-lime-100 dark:bg-gray-600 dark:border-gray-700 p-4 my-10 space-y-2">
                <div class="w-3/12 lg:w-2/12">
                    <img src="/assets/images/avatars/{{ $post->users->avatar }}" class="mx-auto rounded-full h-20 border border-gray-400 p-1">
                </div>
                <div class="w-full lg:w-10/12">
                    <p class="font-bold text-center text-gray-700 dark:text-gray-300">{{ $post->users->name }}</p>
                    @if (empty($post->users->bio))
                    <!-- If no user Bio -->
                    <p class="text-center">User has not provided any information about themselves.</p>
                    @else
                        <!-- display user Bio -->
                        <p class="text-center text-sm dark:text-gray-200">{{ $post->users->bio }}</p>
                    @endif   
                </div>
            </div>

            <!-- Comments section, layout and formatting handled in comments.blade.php -->

            @include('comments', ['comments' => $post->comments, 'model' => $post])
        </div>
        <!-- Wrapper for the sidebar content -->
        <div class="hidden md:block w-3/12 mt-10">
            <H2 class="text-xl font-bold mb-4 dark:text-white">Recent Posts:</H2>
            @foreach ($recentPosts as $recentPost)
                <div class="mb-6">
                    <img src="{{ asset($recentPost->small_image) }}" class="h-[150px] w-full rounded border dark:border-gray-700 p-1" alt="">
                    <h3 class="font-bold mt-2 dark:text-white"><a href="/blog/{{ $recentPost->slug }}">{{ $recentPost->title }}</a></h2>
                </div>               
            @endforeach
        </div>

    </div>
    
    <script>
    // This handles the dropdown of the table of contents
        document.addEventListener("DOMContentLoaded", function () {
            const tocTitle = document.getElementById('toc-title');
            const tocList = document.getElementById('toc-list');
            const tocArrow = document.getElementById('toc-arrow');

            // Toggle the visibility of the table of contents
            tocTitle.addEventListener('click', function () {
                tocList.classList.toggle('hidden'); // Show or hide the TOC list
                tocArrow.classList.toggle('rotate-90'); // Rotate the arrow indicator
            });
        });
    </script>

@endsection