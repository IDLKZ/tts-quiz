@push("styles")
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@extends('layout-employee')
@section('content')


    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black">
                            Создание задачи
                        </p>
                    </div>
                </div>
            </div>
                <livewire:employee.task.create/>
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
@push("scripts")
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function (){
            ClassicEditor
                .create( document.querySelector( '#editor' ),
                    {
                        ckfinder: {
                            uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                        }
                    }
                )
                .catch( error => {
                    console.error( error );
                } );

            $('#start_date').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
            $('#end_date').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
        })

    </script>
@endpush
