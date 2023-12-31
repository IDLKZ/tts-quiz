@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-9 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                            Литература: {{$literature->title}}
                        </p>
                    </div>
                    <div class="col-12 col-md-3 my-2 flex justify-content-end align-items-end">
                        <a href="{{route("literatures-lists")}}" class="btn btn-warning text-white">
                            <i class="fas fa-book mr-2"></i>Литература
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="grid grid-cols-12 gap-5 my-5">
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <img class="shadow-lg max-w-full rounded-lg" src="{{$literature->getFile("image_url")}}"/>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-8 h-full bg-white rounded-lg shadow-lg p-3">
                        <p class="text-md lg:text-lg xl:text-2xl text-black font-bold">
                            {{$literature->title}}
                        </p>
                        @if($literature->literature_category)
                            <small class="my-2 text-md">
                                #{{$literature->literature_category->title}}
                            </small>
                        @endif
                        <hr/>
                        <p class="text-sm md:text-md text-gray-300 py-3">
                            {!! $literature->description !!}
                        </p>
                        <div class="border border-gray-400 p-3 rounded-lg my-4 flex align-items-center">
                            <a href="{{$literature->getFile("file_url")}}" download class="text-md cursor-pointer font-bold">
                                @if(\App\Http\Services\DocumentTypeService::checkIfPdf($literature->file_type))
                                <i class="fas fa-file-pdf text-red-400 mr-2"></i>
                                @elseif(\App\Http\Services\DocumentTypeService::isWord($literature->file_type))
                                    <i class="fas fa-file-word text-blue-400 mr-2"></i>
                                @elseif(\App\Http\Services\DocumentTypeService::isExcel($literature->file_type))
                                    <i class="fas fa-file-excel text-green-400 mr-2"></i>
                                @elseif(\App\Http\Services\DocumentTypeService::isPowerPoint($literature->file_type))
                                    <i class="fas fa-file-powerpoint text-orange-400 mr-2"></i>
                                @else
                                    <i class="fas fa-file-alt text-warning mr-2"></i>
                                @endif
                                {{$literature->title}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="container">
                <div class="grid grid-cols-12 gap-5 my-5">
                    <div class="col-span-12">
                        <canvas id="the-canvas"></canvas>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection

