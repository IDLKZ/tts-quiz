@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="md:text-lg lg:text-2xl">
                            Список Разделов Рабочей Документации
                        </p>
                        <p class="text-sm lg:text-md">
                            Здесь вы можете увидеть список рабочей документации
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{route("document-category.create")}}" class="btn btn-primary">Создать раздел</a>
                    </div>
                </div>

                <div class="row my-5">
                    @foreach($categories as $category)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                            <div class="card h-full shadow-lg">
                                <section class="py-2 px-3 border-t-[20px] border-warning border-tr-xl border-tl-xl rounded-lg">
                                    <div class="header min-h-[50px]">
                                        <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                            {{$category->title}}
                                        </p>
                                    </div>
                                    <div class="header py-3">
                                        <p class="text-md lg:text-lg font-weight-bold text-black text-info">
                                            <i class="fas fa-book"></i>
                                            {{$category->documents_count}}
                                        </p>
                                    </div>
                                    <div class="flex justify-content-between">
                                        <a href="{{route("document-category.edit",$category->id)}}" class="btn btn-warning text-white">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <form action="{{route('document-category.destroy',$category->id)}}" method="post">
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
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
