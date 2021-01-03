@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список компаний</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('company.update', $company->id)}}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Редактировать</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" class="form-control" name="title" value="{{$company->title}}" placeholder="наименование">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('company.index')}}" class="btn btn-secondary waves-effect">Назад</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Обновить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
        </div>
    </div>

@endsection
