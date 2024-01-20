<div class="row my-2 py-4">
    <div class="col-12 my-4">
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
    <div class="col-12 bg-white shadow-lg rounded-lg p-3">
        <form id="js-form" action="{{route("permission.store")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Наименование разрешения *</label>
                <div>
                    <input  wire:model="name" class="form-control  @error('name') is-invalid @enderror" name="name" type="text" value="{{old("name")}}" >
                </div>
            </div>
            @if($this->name)
            <div class="text-right">
                <button class="btn btn-success text-white">
                    Создать
                </button>
            </div>
            @endif
        </form>
    </div>

</div>


