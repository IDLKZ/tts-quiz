@extends('layout')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Массовая загрузка</h4>
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{route("upload-user")}}" method="post" id="js-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Отдел</label>
                                            <div class="col-md-10">
                                                <select name="department_id" id="select-company" class="form-control">
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->title}}  ({{$department->company->title}})</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Загрузить файл excel</label>
                                            <div class="col-md-10">
                                                <input type="file" name="excel" class="form-control">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Отправить</button>
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



