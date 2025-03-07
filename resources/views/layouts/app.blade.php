<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">
        <link rel="mask-icon" href="{{ asset('/assets/images/site/auschwitz-gate.jpg') }}" color="#5bbad5">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="author" content="Lee Wisener">
        <meta name="keywords" content="Holocaust, Auschwitz, Birkenau, Treblinka, Nazis, Poland, Jew, Death, Camps, Ghetto, Concentration">
        <title>{{ $page->title ?? 'Holocaust Research' }}</title>
        <meta name="description" content="{{ $page->summary ?? 'Holocuast history and research site dedicated to learning and understanding more about the Holocaust' }}">

        
        @isset($page)
        <!-- Twitter Meta -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@wisenerl" />
        <meta name="twitter:title" content="{{ $page->title }}" />
        <meta name="twitter:description" content="{{ $page->pagesummary }}" />
        <meta name="twitter:image" content="{{ asset($page->small_image) }}" />
    
        <!-- Open Graph Meta -->
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ $page->title }}" />
        <meta property="og:description" content="{{ $page->pagesummary }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ asset($page->small_image) }}" />
        @endisset

        <!-- moved this to the top due to FOUC -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Venobox css -->
        <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}" type="text/css" media="screen" />
        <script type="text/javascript" src="{{ asset('assets/js/venobox.min.js') }}"></script>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/images/site/auschwitz-gate.jpg') }}">

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/0ff5084395.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    </head>
    <body class="flex flex-col font-sans antialiased min-h-screen max-w-screen-xl mx-auto px-4 xl:px-0 bg-white dark:bg-[#282c35]">

        <!-- header Section -->

        <!-- Top Bar -->
        <div class="mt-4">
            <div class="flex mb-4">
                <div class="flex items-center w-2/12">
                    <ul class="flex items-center space-x-4">
                        <li><a href="https://www.facebook.com/lee.wisener" aria-label="Facebook profile"><i class="fa-brands fa-square-facebook dark:text-white"></i></a></li>
                        <li><a href="https://x.com/wisenerl" aria-label="X (formerly Twitter) profile"><i class="fa-brands fa-x-twitter dark:text-white"></i></a></li>
                    </ul>
                </div>
                <div class="flex-grow text-center">
                    <p class="text-2xl font-bold dark:text-white">HolocaustResearch<span class="text-sm font-normal text-slate-500 dark:text-gray-400">.net</span></p>
                </div>
                <div class="w-2/12 flex justify-end">
                    <!-- Sun icon for Light Mode -->
                    <button id="dark-mode-toggle-on" aria-label="Light Mode" class="hidden" onclick="toggleDarkMode()">
                        <i class="fa-solid fa-sun text-yellow-300"></i>
                    </button>
                    <!-- Moon icon for Dark Mode -->
                    <button id="dark-mode-toggle-off" aria-label="Dark Mode" class="" onclick="toggleDarkMode()">
                        <i class="fa-solid fa-moon text-gray-500"></i>
                    </button>
                </div>
        </div>

                
    <!-- =======================
         Navigation Section
    ======================== -->
    <div class="w-full border-y dark:border-gray-700">
        <!-- Mobile Menu Toggle (visible on small screens) -->
        <div class="md:hidden flex justify-center items-center p-4">
            <button id="mobileMenuToggle" class="text-gray-800 focus:outline-none" aria-label="Toggle mobile menu">
                <!-- Hamburger Icon -->
                <svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          stroke-width="2" 
                          d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu (hidden by default) -->
        <div id="mobileMenu" class="md:hidden bg-gray-100 border-t dark:border-t-gray-700 hidden">
            <ul class="flex flex-col space-y-2 py-4 px-6 dark:bg-gray-700 dark:text-white">
                <!-- Basic Links -->
                <li><a href="/" class="block py-2">Home</a></li>
                <li><a href="/blog" class="block py-2">Blog</a></li>

                <!-- Categories + Articles -->
                @if (!empty($categoriesWithNavigation) && $categoriesWithNavigation->count() > 0)
                    @foreach ($categoriesWithNavigation as $category)
                        <li class="relative">
                            <a href="#" class="block py-2" 
                               id="mobileCategoryDropdownToggle-{{ $category->id }}" 
                               role="button">
                                {{ $category->name }}
                            </a>
                            @if ($category->article->count() > 0)
                                <ul id="mobileCategoryDropdown-{{ $category->id }}" class="pl-4 hidden">
                                    @foreach ($category->article as $article)
                                        <li class="py-1">
                                            <a href="/article/{{ $article->slug }}" class="block">
                                                {{ $article->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif

                <!-- Additional Links (MATCH Desktop) -->
                <li><a href="/quotes" class="block py-2">Quotes</a></li>
                <li><a href="/gallery" class="block py-2">Gallery</a></li>
                <li><a href="/timeline" class="block py-2">Timeline</a></li>
                <li><a href="/links" class="block py-2">Links</a></li>
                <li><a href="/contact" class="block py-2">Contact</a></li>
                <li><a href="/about" class="block py-2">About</a></li>

                <!-- Authenticated User -->
                @if (Auth::check())
                    <li class="relative">
                        <a href="#" class="block py-2" id="mobileUserDropdownToggle" role="button">
                            {{ Auth::user()->name }} <i class="fa-solid fa-angles-down ml-2"></i>
                        </a>
                        <ul id="mobileUserDropdown" class="pl-4 hidden">
                            <!-- Example: Member role -->
                            @if (Auth::user()->has_user_role('Member'))
                                <li class="py-1">
                                    <a href="/profile/{{ Auth::user()->name_slug }}" class="block">Profile</a>
                                </li>
                                <li class="py-1">
                                    <a href="/support" class="block">Support</a>
                                </li>
                            @endif
                            <!-- Example: Admin role -->
                            @if (Auth::user()->has_user_role('Admin'))
                                <li class="py-1">
                                    <a href="/admin" class="block">Admin</a>
                                </li>
                            @endif
                            <!-- Logout -->
                            <li class="py-1 text-red-500">
                                <a href="/logout" class="block">Logout</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Guest Links -->
                    <li><a href="/login" class="block py-2">Login</a></li>
                    <li><a href="/register" class="block py-2">Register</a></li>
                @endif
            </ul>
        </div>

        <!-- Desktop Navigation Menu (visible on md+ screens) -->
        <div class="hidden md:flex justify-center space-x-4 py-4 dark:text-white">
            <ul class="flex justify-center space-x-4">
                <!-- Basic Links -->
                <li><a href="/">Home</a></li>
                <li><a href="/blog">Blog</a></li>

                <!-- Categories + Articles -->
                @if (!empty($categoriesWithNavigation) && $categoriesWithNavigation->count() > 0)
                    @foreach ($categoriesWithNavigation as $category)
                        <li class="relative">
                            <a href="#" class="flex items-center" 
                               id="categoryDropdownToggle-{{ $category->id }}" 
                               role="button">
                                {{ $category->name }}
                            </a>
                            @if ($category->article->count() > 0)
                                <ul id="categoryDropdown-{{ $category->id }}" 
                                    class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-700 
                                           rounded-md shadow-lg hidden z-50">
                                    @foreach ($category->article as $article)
                                        <li class="px-4 py-2 hover:bg-lime-100 hover:rounded dark:hover:bg-gray-500">
                                            <a href="/article/{{ $article->slug }}" class="text-sm">
                                                {{ $article->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif

                <!-- Additional Links -->
                <li><a href="/quotes">Quotes</a></li>
                <li><a href="/gallery">Gallery</a></li>
                <li><a href="/timeline">Timeline</a></li>
                <li><a href="/links">Links</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/about">About</a></li>

                <!-- Authenticated User -->
                @if (Auth::check())
                    <li class="relative">
                        <a href="#" class="flex items-center text-lime-700" 
                           id="userDropdownToggle" 
                           role="button">
                            {{ Auth::user()->name }} 
                            <i class="fa-solid fa-angles-down ml-2"></i>
                        </a>
                        <ul id="userDropdown" 
                            class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-700 
                                   rounded-md shadow-lg hidden z-50">
                            @if (Auth::user()->has_user_role('Member'))
                                <li class="px-4 py-2 hover:bg-lime-100 hover:rounded dark:hover:bg-gray-500">
                                    <a href="/profile/{{ Auth::user()->name_slug }}">Profile</a>
                                </li>
                                <li class="px-4 py-2 hover:bg-lime-100 hover:rounded dark:hover:bg-gray-500">
                                    <a href="/support">Support</a>
                                </li>
                            @endif
                            @if (Auth::user()->has_user_role('Admin'))
                                <li class="px-4 py-2 hover:bg-lime-100 hover:rounded dark:hover:bg-gray-500">
                                    <a href="/admin">Admin</a>
                                </li>
                            @endif
                            <li class="px-4 py-2 text-red-500 hover:bg-lime-100 hover:rounded dark:hover:bg-gray-500">
                                <a href="/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Guest Links -->
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>

        <!-- Content Section -->
        <div class="flex-grow my-10">
            @yield('content')
        </div>

        <!-- Footer Section -->
        <footer class="border-t dark:border-t-gray-700">
            <p class="text-center text-sm text-slate-700 dark:text-gray-400 py-4">Copyright 2025, All rights Reserved.  <a href="https://holocaustresearch.net">HolocaustResearch.net</a> built and maintained by Lee Wisener</p>
        </footer>
        <!-- Scripts -->
        <!-- jQuery (Add it before other scripts update to 3.6.4) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        

    </body>



</html>


