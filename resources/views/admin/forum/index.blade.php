@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="md:text-lg lg:text-2xl">
                            Список Форумов
                        </p>
                        <p class="text-sm lg:text-md">
                            Здесь вы можете увидеть список форумов
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{route("forum.create")}}" class="btn btn-primary">Создать форум</a>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-12 bg-white p-5 rounded-lg shadow-lg">
                        <livewire:admin.forum.forum-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
