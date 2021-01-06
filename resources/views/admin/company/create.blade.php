@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Добавить компанию</h4>
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
                                    <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Создать новую компанию</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Наименование</label>
                                            <input type="text" class="form-control" name="title" placeholder="наименование">
                                            <label class="mt-3">Описание (необязательно)</label>
                                            <textarea name="description" id="editor"></textarea>
                                            <label class="mt-3">Лого (необязательно)</label>
                                            <input type="file" class="form-control" name="logo">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('company.index')}}" class="btn btn-secondary waves-effect">Назад</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Сохранить</button>
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
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
