<div class="container">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-3">
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
                            @foreach($categories as $category)
                                <div class="flex items-center align-items-center">
                                    <input wire:model="categories_ids" id="{{$category->title}}" type="checkbox" value="{{$category->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2">
                                    <label for="{{$category->title}}" class="m-2 text-sm font-medium text-gray-900 ">
                                        {{$category->title}}
                                    </label>
                                </div>
                            @endforeach
                            <div class="flex items-center align-items-center">
                                <input wire:model="is_resolved" checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2">
                                <label for="checked-checkbox" class="m-2 text-sm font-medium text-gray-900">Вопрос решен</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-9">
            @foreach($tickets as $ticket)
                <section class="my-2 bg-gray-100">
                    <div class="block p-3 bg-white border border-gray-200 rounded-lg shadow mb-3">
                        <a href="{{route("ticket.show",$ticket->id)}}">
                            <div class="flex align-items-center">
                                <div
                                    class="flex items-center
                                        h-10 w-10
                                        justify-center
                                        rounded-full flex-shrink-0
                                        bg-center bg-no-repeat bg-cover
                                        "
                                    style="background-image:url({{$ticket->user->img}})"
                                >
                                </div>
                                <p class="ml-2 font-bold">
                                    {{$ticket->user->name}}
                                </p>
                            </div>
                            <div class="px-2">
                                <p class="text-md font-bold lg:text-lg">
                                    {{$ticket->title}}
                                </p>
                                <p class="text-blue-400 dark:text-blue-400">
                                    #{{$ticket->category->title}} <br/>
                                    Создан {{$ticket->created_at->format("H:i d/m/Y")}}
                                </p>
                                @if($ticket->updated_at)
                                    <p class="text-blue-400 dark:text-blue-400">
                                        Обновлен {{$ticket->updated_at->format("H:i d/m/Y")}}
                                    </p>
                                @endif
                                <p>
                                    <i class="fas fa-comment text-info"></i>
                                    {{$ticket->ticket_messages_count}}
                                </p>
                            </div>
                            <div class="flex mt-3">
                                @if($ticket->is_answered)
                                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-3 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                        <i class="fas fa-check mr-2"></i>
                                        Отвечен
                                    </button>
                                @else
                                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <i class="fas fa-times-circle mr-2"></i>
                                        Не отвечен
                                    </button>
                                @endif
                                @if($ticket->is_resolved)
                                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-3 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                        <i class="fas fa-check mr-2"></i>
                                        Решен!
                                    </button>
                                @else
                                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <i class="fas fa-times-circle mr-2"></i>
                                        Не решен
                                    </button>
                                @endif
                            </div>
                        </a>
                        <div class="md:flex justify-content-end">
                            <form id="closeTicketForm" action="{{route("ticket.destroy",$ticket->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmClose()" class="block text-white bg-red-700 hover:bg-red-800 rounded-full focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center " type="button">
                                    <i class="fas fa-trash mr-2"></i>
                                    Удалить тикет
                                </button>
                            </form>
                        </div>
                    </div>

                </section>


            @endforeach
        </div>
        <div class="col-span-12 flex justify-center my-2">
            {{$tickets->links()}}
        </div>
    </div>

</div>
</div>
@push("scripts")
    <script>
        function confirmClose()
        {
            var agree=confirm("Вы уверены?");
            if (agree)
                $("#closeTicketForm").submit();
            else
                return false ;
        }
    </script>
@endpush
