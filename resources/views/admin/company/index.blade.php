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
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route('company.create')}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi-plus mr-1"></i> Добавить
                                    </a>
                                </div>
                            </div>
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
                                    <div class="table-responsive">
                                        <h4 class="header-title">Компании</h4>
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Logo</th>
                                                <th>Наименование</th>
                                                <th>Описание</th>
                                                <th>Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($companies as $company)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <th><img src="{{$company->logo}}" class="rounded-circle header-profile-user"></th>
                                                    <td>{{$company->title}}</td>
                                                    <td>{!! $company->description !!}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{route('company.edit', $company->id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <form action="{{route('company.destroy', $company->id)}}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return (prompt('Вы уверены? Напишите 0000 чтобы удалить') == '0000' ? true : false)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$companies->links()}}
                                    </div>

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

