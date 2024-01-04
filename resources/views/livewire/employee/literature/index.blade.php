<div class="container">
    <div class="grid grid-cols-12 gap-3 my-3">
        <div class="col-span-12">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Поиск</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model="search" type="search" id="default-search" class="block w-full py-3 px-5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Поиск..." required>
                    <button type="submit" class="text-white absolute end-5 bottom-[10px] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Искать!</button>
                </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-3 my-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="card w-full shadow-md rounded-lg bg-white p-3">
                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1">
                        <button type="button" class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                            <span class="flex items-center">
                                <i class="fas fa-bars mr-2"></i>
                                Категории
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-1" class="" aria-labelledby="accordion-open-heading-1">
                        <div class="p-3 border border-b-0 border-gray-200">
                            @if($categories)
                                @foreach($categories as $category)
                                    <div class="flex align-items-center items-center my-2">
                                        <input wire:model="category_ids" value="{{$category->id}}" id="{{$category->title}}" type="checkbox" class="w-4 h-4 text-md lg:text-lg text-yellow-500 focus:bg-yellow-500 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-yellow-500 mr-2">
                                        <label for="{{$category->title}}" class="text-sm font-medium text-gray-900 mb-0">{{$category->title}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-8">
           <div class="grid grid-cols-12 gap-3">
               @foreach($literatures as $literature)
               <div class="col-span-12 md:col-span-6 lg:col-span-6 xl:col-span-4">
                   <div class="card shadow-lg rounded-lg min-h-[350px] lg:min-h-[500px]">
                       <div class="card-image z-10 brightness-50 rounded-lg min-h-[350px] lg:min-h-[500px] background-no-repeat background-center bg-cover" style="background-image:url({{$literature->getFile("image_url")}})"></div>
                        <div class="absolute text-md lg:text-lg font-weight-bold z-20 text-white p-3 bottom-[10px] left-[10px] w-full">
                            <section>
                                <a href="{{route("literaturesShow",$literature->id)}}" class="hover:text-yellow-300" href="">
                                    {{\Illuminate\Support\Str::limit($literature->title,50)}}
                                </a>
                                @if($literature->literature_category)
                                <p class="text-xs lg:text-md font-weight-bold">
                                    # {{\Illuminate\Support\Str::limit($literature->literature_category->title,50)}}
                                </p>
                                @endif
                            </section>
                            <section class="text-right mt-3">
                                <a href="{{route("literaturesShow",$literature->id)}}" class="btn bg-yellow-400 hover:bg-yellow-600 text-white rounded-full">
                                    <i class="fas fa-eye"></i> Читать
                                </a>
                            </section>
                        </div>
                   </div>
               </div>
               @endforeach
               <div class="col-span-12 my-3 flex justify-content-center items-center">
                   {{$literatures->links()}}
               </div>
           </div>
        </div>
    </div>
</div>
