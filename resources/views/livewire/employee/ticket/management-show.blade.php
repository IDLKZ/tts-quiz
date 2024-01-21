@push("css")
    <link href=" https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-image@40.2.0/theme/image.min.css " rel="stylesheet">
@endpush
<section>
    <div class="h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div class="flex flex-col h-full">
                            <div class="grid grid-cols-12 gap-y-2">
                                @if($ticket)
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="flex items-center
                                        h-10 w-10
                                        justify-center
                                        rounded-full flex-shrink-0
                                        bg-center bg-no-repeat bg-cover
                                        "
                                                style="background-image:url({{$ticket->user->img}})"
                                            >
                                            </div>
                                            <div
                                                class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl"
                                            >
                                                <div>
                                                    <div class="img-control">
                                                        <p class="my-3 font-bold">
                                                            {{$ticket->user->name}}:
                                                        </p>
                                                        {{$ticket->title}}:<br/>
                                                        {!! $ticket->description !!}
                                                        @if($ticket->file_url)
                                                            <div class="my-2 flex text-sm">
                                                                <a class="text-info" href="{{$ticket->getFile('file_url')}}" download> <i class="fas fa-file mr-1"></i> Файл</a>
                                                            </div>
                                                        @endif
                                                        <small>
                                                            {{$ticket->created_at->format("H:i d/m/Y")}}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($messages)
                                    @foreach($messages as $message)
                                        @if($message->user_id != $ticket->user_id)
                                            <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                                <div class="flex items-center justify-start flex-row-reverse">
                                                    <div
                                                        class="flex items-center
                                                        h-10 w-10
                                                        justify-center
                                                        rounded-full flex-shrink-0
                                                        bg-center bg-no-repeat bg-cover
                                        "
                                                        style="background-image:url({{$message->user->img}})"
                                                    >
                                                    </div>
                                                    <div
                                                        class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl"
                                                    >
                                                        <div>
                                                            <p class="my-3 font-bold">
                                                                {{$message->user->name}}:
                                                            </p>
                                                            {!! $message->message !!} <br>
                                                            @if($message->file_url)
                                                                <div class="my-2 flex text-sm">
                                                                    <a class="text-info" href="{{$message->getFile('file_url')}}" download> <i class="fas fa-file mr-1"></i> Файл</a>
                                                                </div>
                                                            @endif
                                                            <small>
                                                                {{$message->created_at->format("H:i d/m/Y")}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                <div class="flex flex-row items-center">
                                                    <div
                                                        class="flex items-center
                                                        h-10 w-10
                                                        justify-center
                                                        rounded-full flex-shrink-0
                                                        bg-center bg-no-repeat bg-cover
                                                        "
                                                        style="background-image:url({{$ticket->user->img}})"
                                                    >
                                                    </div>
                                                    <div
                                                        class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl"
                                                    >
                                                        <div>
                                                            <div class="img-control">
                                                                <p class="my-3 font-bold">
                                                                    {{$message->user->name}}:
                                                                </p>
                                                                {!! $message->message !!} <br/>
                                                                @if($message->file_url)
                                                                    <div class="my-2 flex text-sm">
                                                                        <a class="text-info" href="{{$message->getFile('file_url')}}" download> <i class="fas fa-file mr-1"></i> Файл</a>
                                                                    </div>
                                                                @endif
                                                                <small>
                                                                    {{$message->created_at->format("H:i d/m/Y")}}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($ticket->is_resolved == false)
        <div class="lg:flex flex-row items-center rounded-xl bg-white w-full px-4 py-3 h-full">
            <div class="lg:flex-grow ml-4">
                <div class="relative w-full">
                    <div class="my-2 p-3">

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Загрузить файл (необязательно)</label>
                        <input wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                    </div>
                    <section wire:ignore>
                    <textarea
                        id="editor"
                        wire:model="messageText"
                        type="text"
                        class=" w-full border rounded-xl focus:outline-none focus:border-indigo-300"
                    ></textarea>
                    </section>

                </div>
            </div>
            <div class="ml-4">
                <button
                    wire:click="addMessage"
                    class="text-right flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0 my-3"
                >
                    <span>Отправить</span>
                    <span class="ml-2">
                  <svg
                      class="w-4 h-4 transform rotate-45 -mt-px"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                    ></path>
                  </svg>
                </span>
                </button>
            </div>
        </div>
    @endif

</section>


@push("scripts")
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function (){
            let classicEditor;
            ClassicEditor
                .create( document.querySelector( '#editor' ),
                    {
                        ckfinder: {
                            uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                        },
                    }
                )
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('messageText', editor.getData());
                        classicEditor = editor;
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
            Livewire.on('emptyCKEditor', () => { classicEditor.setData(''); })
        })
    </script>
@endpush
