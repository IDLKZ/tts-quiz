@extends('layout')
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
                        <a href="{{route("ticket.index")}}" class="btn btn-warning text-white">
                            <i class="fas fa-eye"></i> Все тикеты
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
                                    <form id="closeTicketForm" action="{{route("ticket.update",$ticket->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" onclick="confirmClose()" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                                            Закрыть тикет
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </a>

                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- end page title end breadcrumb -->
            <livewire:admin.ticket.show :ticket="$ticket"/>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->
    <!-- Main modal -->
@endsection
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
