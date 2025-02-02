@extends('layouts.app')

@section('content')

    <div class="flex justify-between space-x-10 my-10">

        <!-- Display Gallery Image -->
        <div class="w-9/12">
            <div class="">
                <div class="mb-4">
                    <h2 class="font-bold text-2xl text-center mb-2">{{ $page->title }}</h2>
                    <p class="w-3/4 mx-auto text-center text-sm text-gray-600">{{ $page->summary }}</p>
                </div>
                <div class="border">
                    <img class="w-full rounded shadow-lg" src="{{ asset('/storage/images/gallery/' . $page->category->name . '/' . $page->album->name . '/' . 'large_' . $page->image) }}" alt="{{ $page->title }}">
                </div>
                <div class="mt-4">
                    <ul class="flex justify-center space-x-10">
                        <li class=""><i class="fa-solid fa-clock mr-2"></i> {{ $page->date_taken }}</li>
                        <li class=""><i class="fa-solid fa-location-crosshairs mr-2"></i> {{ $page->location }}</li>
                        <li class=""><a href="{{ asset('/storage/images/gallery/' . $page->category->name . '/' . $page->album->name . '/' . $page->image) }}" 
                            target="_blank" class=""><i class="fa-solid fa-image"></i> Open Original Image*</a>
                        </li>
                    </ul>
                </div>
                <div class="my-4 text-center">
                    {{ $page->text }}
                </div>
                <div class="flex justify-center space-x-4 mt-4">
                    @foreach($page->tags as $tag)
                        <div class="wise-button-sm">
                            <a href="../gallery?tag={{ $tag->name }}">{{ $tag->name }}</a>
                        </div>
                    @endforeach     
                </div>
                <div class="text-sm my-10 text-slate-500 text-center">
                    <p>*if you click the link to open the original image be aware that some are several
                    megabytes in size.  They may open slowly depending on your internet speed.  Be morer cautious of doing this on mobile devices with limited data, it could use up
                    your data quite quickly.</p>
                </div>
            </div>
            <div class="my-10">
             <!-- Comments Section -->
            @include('comments', ['comments' => $page->comments, 'model' => $page])
            </div>
        </div>

        <div class="w-3/12">
            <!-- Image count -->
            <div class="flex flex-col items-center justify-center  mb-4 border shadow-lg p-2">
                <h3 class="font-bold text-lg">Total Gallery Images</h3>
                <p class="text-slate-500 font-bold">{{ $imageTotal }}</p>        
            </div>
            <!-- Gallery Search Box -->
            <div class="py-4 w-full mx-auto">
                <form action="/gallery">
                    <input type="text" class="shadow-lg p-2 border-gray-300 w-full hover:border-gray-600" name="search" id="search" placeholder="Search for images..">
                </form>
            </div>
            <!-- Gallery Categories -->
            <div class="py-4">
                <h2 class="border-b font-bold text-lg mb-4">Categories</h2> 
                <ul>
                    @foreach( $categories as $category )
                        <li class=""><a href="../gallery?category={{ $category->name }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- Popular Tags -->
            <div class="">
                <h2 class="border-b font-bold text-lg mb-4">Popular Tags</h2> 
                @foreach ($popularTags as $tag)
                    <div class="inline-flex pb-2 pr-2">
                        <a href="../gallery?tag={{ $tag->name }}" class="wise-button-sm">{{ $tag->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


@endsection