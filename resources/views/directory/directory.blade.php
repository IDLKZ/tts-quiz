@extends($layout)
@push("styles")
    <style>
        #department {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Справочник</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Главная</a></li>
                                <li class="breadcrumb-item active">Справочник</li>
                            </ol>
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
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="text-center mt-4">
                                                <h4>Справочник</h4>
                                                <p class="text-muted">Здесь вы можете посмотреть информацию сотрудников</p>
                                            </div>
{{--                                            @admin--}}
{{--                                            <form action="{{route('adminDirectoryGetUsers')}}" method="post">--}}
{{--                                                @endadmin--}}
{{--                                                @employee--}}
{{--                                            <form action="{{route('employeeDirectoryGetUsers')}}" method="post">--}}
{{--                                                @endemployee--}}
{{--                                                @csrf--}}
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <select name="company" id="company" class="form-control">
                                                        <option value="">Выберите компанию</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <div class="card border shadow-none">--}}
{{--                                                        <livewire:directory.company--}}
{{--                                                            name="company_id"--}}
{{--                                                            placeholder="Выберите компанию"--}}
{{--                                                        />--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <div class="card border shadow-none">--}}
{{--                                                        <livewire:directory.department--}}
{{--                                                            name="department_id"--}}
{{--                                                            placeholder="Выберите отдел"--}}
{{--                                                            :depends-on="['company_id']"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-4">--}}
{{--                                                    <button type="submit" class="btn btn-info mt-1 waves-effect waves-light"><i class="fas fa-search mr-1"></i>Поиск</button>--}}
{{--                                                </div>--}}
                                            </div>
{{--                                            </form>--}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

{{--                                    @if (isset($users))--}}
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive" id="department">
                                                            <h4 class="header-title">Департаменты</h4>

{{--                                                            {!! $users->links() !!}--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                    @endif--}}

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
@push("scripts")
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#company").on('change', function(){
                var faculties = parseInt( $("#company").val() );
                selectCompany(faculties);
            });

            function selectCompany(id) {
                var department = $('#department');
                clear(department)
                if (id > 0) {
                    department.fadeIn('slow')
                    // department.css('display', 'block')
                    department.load(
                        '/get-department',
                        {id: id}
                    )
                }
            }

            function clear(val) {
                val.css('display', 'none');
            }
        })

    </script>
@endpush
