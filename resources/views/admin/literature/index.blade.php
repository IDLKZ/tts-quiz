@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список литературы</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список литературы</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("literature.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick  mr-1"></i> Добавить
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                    <div class="row my-5">
                        @foreach($literatures as $literature)
                            <div class="col-12 col-md-6 col-lg-4 my-2">
                                <div class="card h-full shadow-lg">
                                    <section class="py-2 px-3 border-t-[20px] border-warning border-tr-xl border-tl-xl rounded-lg">
                                        <div class="card-image min-h-[300px] background-no-repeat background-cover" style="background-image:url({{$literature->getFile("image_url")}})"></div>
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{\Illuminate\Support\Str::limit($literature->title,30)}}
                                            </p>
                                        </div>
                                        <div class="flex justify-content-between">
                                            <a href="{{route("literature.edit",$literature->id)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="{{route('literature.destroy',$literature->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger text-white">
                                                    <i class="far fa-times-circle"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 flex justify-content-center align-items-center">
                            {{$literatures->links()}}
                        </div>
                    </div>
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->


    </div>
@endsection
