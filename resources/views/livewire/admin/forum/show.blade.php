@push("css")
    <link href=" https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-image@40.2.0/theme/image.min.css " rel="stylesheet">
@endpush
<div>
    <section class="row min-h-[350px] ">
        <div class="col-12 my-3 p-3 border-1 bg-white p-5 rounded-lg shadow-lg">
            <div class="mb-3">
                <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white rounded-lg antialiased">
                    <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
                        <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
                            <header>
                                <address class="flex items-center not-italic">
                                    <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                                        <img class="mr-2 w-16 h-16 rounded-full" src="{{$forum->user->img}}" alt="{{$forum->user->name}}">
                                        <div>
                                            <a href="#" rel="author" class="text-xl font-bold text-gray-900">{{$forum->user->name}}</a>
                                            <p class="text-base text-gray-500 ">
                                                {{$forum->user->position}}
                                                @if($forum->department_id)
                                                    {{$forum->department->title}})
                                                @endif
                                            </p>
                                            <p class="text-base text-gray-500">
                                                {{$forum->created_at->diffForHumans()}} ({{$forum->created_at->format('H:i d.m.Y')}})
                                            </p>
                                        </div>
                                    </div>
                                </address>
                                <h1 class="mb-4 text-lg font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-2xl xl:text-3xl 2xl:text-4xl">
                                    {{$forum->title}}
                                </h1>
                                <small class="inline-block mb-4">
                                    #{{$forum->category->title}}
                                </small>
                            </header>
                            <div class="text-gray-700 text-md lg:text-sm">
                                {!! $forum->description !!}
                            </div>
                            <div class="flex items-center mt-4 space-x-4">
                                <button type="button" class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                    <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"></path>
                                    </svg>
                                    {{$forum->forum_messages_count}}
                                </button>
                            </div>
                            <section class="my-3">
                                <div class="form-group" wire:ignore>
                                    <label for="example-text-input" class=" col-form-label">Оставить комментарий *</label>
                                    <div>
                                        <textarea wire:model="message" id="editor" name="message"></textarea>
                                    </div>
                                </div>
                                @if($message)
                                    <div class="text-right">
                                        <button class="btn btn-success text-white" wire:click="createComment">
                                            Создать
                                        </button>
                                    </div>
                                @endif
                            </section>
                            <div class="text-lg">
                                Комментарии
                            </div>
                            @if($comments)
                                @foreach($comments as $commentItem)
                                    <article class="p-6 mb-6 text-base bg-white rounded-lg">
                                        <footer class="flex justify-between items-center mb-2">
                                            <div class="flex items-center">
                                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900">
                                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{$commentItem->user->getFile('image_url')}}" alt="{{$commentItem->user->name}}">{{$commentItem->user->name}}</p>
                                                <p class="text-sm text-gray-600">
                                                    {{$commentItem->created_at->diffForHumans()}} ({{$commentItem->created_at->format("H:i d/m/Y")}})
                                                </p>
                                            </div>
                                            @if($commentItem->user_id == $user->id || $user->role_id == 1)
                                                <button wire:click="removeComment({{$commentItem->id}})" class="text-red-500">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </footer>
                                        <div class="text-sm">
                                            {!! $commentItem->message !!}
                                        </div>
                                        <div class="flex items-center mt-4 space-x-4">
                                            @if($respond != $commentItem->id)
                                                <button wire:click="respondToComment({{$commentItem->id}})" type="button" class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                                    <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                        <path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"></path>
                                                    </svg>
                                                    Ответить
                                                </button>
                                            @endif
                                            <div>
                                                @if($commentItem->forum_message_ratings_sum_rating > 0)
                                                <p class="text-green-500 text-sm">
                                                    +{{$commentItem->forum_message_ratings_sum_rating}}
                                                </p>
                                                @else
                                                    <p class="text-red-500 text-sm">
                                                        {{$commentItem->forum_message_ratings_sum_rating}}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            @if($respond == $commentItem->id)
                                                <section class="my-3">
                                                    <div class="form-group" wire:ignore>
                                                        <label for="example-text-input" class=" col-form-label">Оставить комментарий *</label>
                                                        <div>
                                                            <input type="text" wire:model="subMessage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Оставьте комментарий">
                                                        </div>
                                                    </div>
                                                    @if($subMessage)
                                                        <div class="text-right">
                                                            <button class="btn btn-success text-white" wire:click="createSubComment">
                                                                Отправить
                                                            </button>
                                                        </div>
                                                    @endif
                                                </section>
                                            @endif
                                        </div>
                                        @if($commentItem->forum_messages)
                                            @if(count($commentItem->forum_messages))
                                                @foreach($commentItem->forum_messages as $subCommentItem)
                                                    <article class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg">
                                                        <footer class="flex justify-between items-center mb-2">
                                                            <div class="flex items-center">
                                                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900">
                                                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{$subCommentItem->user->getFile('image_url')}}" alt="{{$subCommentItem->user->name}}">{{$subCommentItem->user->name}}</p>
                                                                <p class="text-sm text-gray-600">
                                                                    {{$subCommentItem->created_at->diffForHumans()}} ({{$subCommentItem->created_at->format("H:i d/m/Y")}})
                                                                </p>
                                                            </div>
                                                            @if($subCommentItem->user_id == $user->id || $user->role_id == 1)
                                                                <button wire:click="removeComment({{$subCommentItem->id}})" class="text-red-500">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @endif
                                                        </footer>
                                                        <div class="text-sm">
                                                            {!! $subCommentItem->message !!}
                                                        </div>
                                                        <div class="flex items-center mt-4 space-x-4">
                                                            <div>
                                                                @if($subCommentItem->forum_message_ratings_sum_rating > 0)
                                                                    <p class="text-green-500 text-sm">
                                                                        +{{$subCommentItem->forum_message_ratings_sum_rating}}
                                                                    </p>
                                                                @else
                                                                    <p class="text-red-500 text-sm">
                                                                        {{$subCommentItem->forum_message_ratings_sum_rating}}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            @endif
                                        @endif
                                    </article>
                                @endforeach
                            @endif
                        </article>
                    </div>
                </main>
            </div>
        </div>

    </section>

</div>

@push("scripts")
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-image@40.2.0/src/index.min.js "></script>
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
                        @this.set('message', editor.getData());
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
