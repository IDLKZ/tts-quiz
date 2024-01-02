@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-lg-9 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                            Мое обращение в техническую поддержку № {{$ticket->id}}
                        </p>
                    </div>
                    <div class="col-12 col-lg-3 my-2 text-right">
                        <a href="{{route("tech-support-ticket-list")}}" class="btn btn-warning text-white">
                            <i class="fas fa-eye"></i> Мои тикеты
                        </a>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 my-2">
                        <a class="block p-3 bg-white border border-gray-200 rounded-lg shadow">
                            <p class="text-md font-bold lg:text-lg">
                                {{$ticket->title}}
                            </p>
                            <p class="text-gray-700 dark:text-gray-400">
                                #{{$ticket->category->title}} <br/>
                                Создан {{$ticket->created_at->format("H:i d/m/Y")}}
                            </p>
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
                                    <!-- Modal toggle -->
                            </div>
                            @if(!$ticket->is_resolved)
                                <div class="md:flex justify-content-end">
                                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                                        Закрыть тикет
                                    </button>
                                </div>

                            @endif
                        </a>

                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- end page title end breadcrumb -->
            <livewire:employee.ticket.show :ticket="$ticket"/>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Закрыть тикет
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Вы собираетесь закрыть тикет, после которого вы не сможете больше отписаться или оставить комментарий
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form action="{{route("tech-support-ticket-update",$ticket->id)}}" method="post">
                        @csrf
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Я согласен закрыть тикет</button>
                    </form>
                    <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Отмена</button>
                </div>
            </div>
        </div>
    </div>
@endsection
