@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="md:text-lg lg:text-2xl">
                            Список документов
                        </p>
                        <p class="text-sm lg:text-md">
                            Здесь вы можете увидеть список документов
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{route("document.create")}}" class="btn btn-primary">Создать документ</a>
                    </div>
                </div>

                <div class="row my-5">
                    @foreach($documents as $document)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                            <div class="card h-full shadow-lg">
                                <section class="py-2 px-3 border-t-[20px] border-warning border-tr-xl border-tl-xl rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-cover" style="background-image:url({{$document->getFile("image_url")}})"></div>
                                    <div class="header">
                                        <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                            {{$document->title}}
                                        </p>
                                    </div>
                                    <div class="flex justify-content-between">
                                        <a href="{{route("document.edit",$document->id)}}" class="btn btn-warning text-white">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <form action="{{route('document.destroy',$document->id)}}" method="post">
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
                        {{$documents->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
