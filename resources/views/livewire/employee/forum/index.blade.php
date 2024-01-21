<div class="container">
    <div class="grid grid-cols-12">
        <div class="col-span-12 my-2">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Поиск</label>
                <div class="relative bg-white shadow-lg rounded-xl">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model="searchInput" type="search" id="default-search" class="block w-full py-4 px-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Поиск..." required>
                    <button wire:click="search" type="submit" class="text-white absolute end-2.5 bottom-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Поиск</button>
                </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 lg:col-span-3 my-5 bg-white shadow-lg rounded-lg p-3">
            <div class="p-3 border border-b-0 border-gray-200">
                <fieldset>
                    @foreach($categories as $category)
                        <div class="flex items-center mb-2">
                            <input wire:model="category_ids" id="{{$category->title}}{{$category->id}}" type="checkbox" value="{{$category->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="{{$category->title}}{{$category->id}}" class="m-2 text-md font-medium text-gray-900 cursor-pointer">
                                <div class="flex align-items-center justify-content-center">
                                    <div
                                        class="flex items-center
                                                    h-10 w-10
                                                    justify-center
                                                    rounded-full flex-shrink-0
                                                    bg-center bg-no-repeat bg-cover mr-1"
                                        style="background-image:url({{$category->getFile("image_url")}})"
                                    >
                                    </div>
                                    <p>
                                        {{$category->title}}
                                    </p>
                                </div>

                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-9 my-5">
            @foreach($forums as $forum)
                <div class="mb-3">
                    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white rounded-lg antialiased">
                        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
                            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                                <header>
                                    <address class="flex items-center not-italic">
                                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                            <img class="mr-2 w-16 h-16 rounded-full" src="{{$forum->user->img}}" alt="{{$forum->user->name}}">
                                            <div>
                                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{$forum->user->name}}</a>
                                                <p class="text-base text-gray-500 dark:text-gray-400">
                                                    {{$forum->user->position}}
                                                    @if($forum->department_id)
                                                        {{$forum->department->title}})
                                                    @endif
                                                </p>
                                                <p class="text-base text-gray-500 dark:text-gray-400">
                                                    {{$forum->created_at->diffForHumans()}} ({{$forum->created_at->format('H:i d.m.Y')}})
                                                </p>
                                            </div>
                                        </div>
                                    </address>
                                    <h1 class="mb-2 text-lg font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-2xl xl:text-3xl 2xl:text-4xl">
                                        {{$forum->title}}
                                    </h1>
                                    <small class="inline-block mb-4">
                                        #{{$forum->category->title}}
                                    </small>
                                </header>
                                <div class="text-gray-700 text-md lg:text-sm">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($forum->description),350) !!}
                                </div>
                                <div class="flex items-center mt-4 space-x-4">
                                    <button type="button" class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                        <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"></path>
                                        </svg>
                                        {{$forum->forum_messages_count}}
                                    </button>
                                </div>
                                <div class="flex justify-content-end mt-4 space-x-4">
                                    <a href="{{route("forumDetail",$forum->id)}}" class="btn btn-info rounded-full px-4 py-2 text-white font-medium">
                                        Читать <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    </main>
                </div>
            @endforeach
        </div>
        <div class="col-span-12 my-3 flex justify-content-center items-center">
            {{$forums->links()}}
        </div>
    </div>
</div>
