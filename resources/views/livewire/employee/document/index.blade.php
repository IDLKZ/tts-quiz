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
                @if($documents)
                            @foreach($documents as $document)
                                <div class="col-span-12 flex justify-center items-center">
                                    <div class="max-w-sm w-full lg:max-w-full lg:flex my-3">
                                        <div class="h-48 lg:h-auto lg:w-48 p-2 flex-none bg-contain bg-no-repeat bg-center bg-white rounded-t py-2 lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url({{$document->getFile("image_url")}})" title="Woman holding a mug">
                                        </div>
                                        <div class="border border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                                            <div class="mb-8">
                                                <div class="text-gray-900 font-bold text-xl mb-2">{{$document->title}}</div>
                                                <p class="text-xs text-gray-700 text-base">
                                                    {!! $document->description !!}
                                                </p>
                                            </div>
                                            <div class="border border-gray-400 p-3 rounded-lg my-4 flex align-items-center">
                                                <a href="{{$document->getFile("file_url")}}" download class="text-md cursor-pointer font-bold">
                                                    @if(\App\Http\Services\DocumentTypeService::checkIfPdf($document->file_type))
                                                        <i class="fas fa-file-pdf text-red-400 mr-2"></i>
                                                    @elseif(\App\Http\Services\DocumentTypeService::isWord($document->file_type))
                                                        <i class="fas fa-file-word text-blue-400 mr-2"></i>
                                                    @elseif(\App\Http\Services\DocumentTypeService::isExcel($document->file_type))
                                                        <i class="fas fa-file-excel text-green-400 mr-2"></i>
                                                    @elseif(\App\Http\Services\DocumentTypeService::isPowerPoint($document->file_type))
                                                        <i class="fas fa-file-powerpoint text-orange-400 mr-2"></i>
                                                    @else
                                                        <i class="fas fa-file-alt text-warning mr-2"></i>
                                                    @endif
                                                    Скачать: {{$document->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                @endif
            </div>
            <div class="col-span-12 my-3 flex justify-content-center items-center">
                {{$documents->links()}}
            </div>
        </div>

    </div>
</div>
