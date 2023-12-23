@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container">
                <livewire:admin.forum.show :forum="$forum"/>
            </div>
        </div>
    </div>
@endsection
