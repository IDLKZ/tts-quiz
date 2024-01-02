@push("css")
    <link href=" https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-image@40.2.0/theme/image.min.css " rel="stylesheet">
@endpush
<div>
    <section class="row min-h-[350px] ">
        <div class="col-12 my-3 p-3 border-1 bg-white p-5 rounded-lg shadow-lg">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-2">
                    <div class="flex justify-content-center">
                        <img src="{{$user->img}}" class="w-full max-w-[150px] rounded-full">
                    </div>
                    <p class="text-md lg:text-xl xl:text-2xl font-weight-bold text-center my-3">
                        {{$forumRating ?? 0}}
                    </p>
                    <div class="flex justify-content-center">
                        <a wire:click="rateForumUp" class="btn btn-success text-white mx-2">
                            <i class="fas fa-thumbs-up"></i>
                        </a>
                        <a wire:click="rateForumDown" class="btn btn-danger text-white mx-2">
                            <i class="fas fa-thumbs-down"></i>
                        </a>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-10 px-5">
                    <div>
                        <div class="text-md lg:text-xl xl:text-2xl">
                            {{$forum->title}}
                        </div>
                        <div class="text-md my-5 border-2 p-3" style="word-break: break-all;">
                            {!! $forum->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="col-12 text-lg">
            Комментарии
        </div>
        @if($comments)
            @foreach($comments as $commentItem)
                <div class="w-full bg-white p-5 rounded-lg shadow-md my-3">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 lg:col-span-2">
                            <div class="flex justify-content-center">
                                <img src="{{$commentItem->user->img}}" class="w-full max-w-[150px] rounded-full">
                            </div>
                            <p class="text-md lg:text-xl xl:text-2xl font-weight-bold text-center my-3">
                                {{$commentItem->user->name}}
                            </p>
                            <p class="text-md lg:text-xl xl:text-2xl font-weight-bold text-center my-3">
                                {{$commentItem->forum_message_ratings_sum_rating ?? 0}}
                            </p>
                            <div class="flex justify-content-center">
                                <a class="btn btn-success text-white mx-2" wire:click="rateMessageUp({{$commentItem->id}})">
                                    <i class="fas fa-thumbs-up"></i>
                                </a>
                                <a class="btn btn-danger text-white mx-2" wire:click="rateMessageDown({{$commentItem->id}})">
                                    <i class="fas fa-thumbs-down"></i>
                                </a>
                            </div>
                            <div class="my-3 text-center">
                                <a class="btn btn-info text-white mx-2" wire:click="setMessage({{$commentItem}})">
                                    Ответить
                                </a>
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-10 px-5">
                            <div>
                                <div class="text-md my-5 border-2 p-3" style="word-break: break-all;">
                                    {!! $commentItem->message !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($commentItem->forum_messages)
                       @if(count($commentItem->forum_messages))
                           @foreach($commentItem->forum_messages as $subCommentItem)
                               <div class="flex justify-content-end">
                                   <section class="w-[90%] my-4">
                                       <div class="grid grid-cols-12 border-l-2  border-gray-200 p-2">
                                           <div class="col-span-12 lg:col-span-2">
                                               <div class="flex justify-content-center">
                                                   <img src="{{$subCommentItem->user->img}}" class="w-full max-w-[150px] rounded-full">
                                               </div>
                                               <p class="text-md lg:text-xl xl:text-2xl font-weight-bold text-center my-3">
                                                   {{$subCommentItem->user->name}}
                                               </p>
                                               <p class="text-md lg:text-xl xl:text-2xl font-weight-bold text-center my-3">
                                                   {{$subCommentItem->forum_message_ratings_sum_rating ?? 0}}
                                               </p>
                                               <div class="flex justify-content-center">
                                                   <a class="btn btn-success text-white mx-2" wire:click="rateMessageUp({{$subCommentItem->id}})">
                                                       <i class="fas fa-thumbs-up"></i>
                                                   </a>
                                                   <a class="btn btn-danger text-white mx-2" wire:click="rateMessageDown({{$subCommentItem->id}})">
                                                       <i class="fas fa-thumbs-down"></i>
                                                   </a>
                                               </div>
                                           </div>
                                           <div class="col-span-12 lg:col-span-10 px-5">
                                               <div>
                                                   <div class="text-md my-5 border-2 p-3" style="word-break: break-all;">
                                                       {!! $subCommentItem->message !!}
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </section>
                               </div>

                            @endforeach

                       @endif
                    @endif
                </div>
            @endforeach


        @endif
    </section>
    <section class="min-h-[350px] max-h-[50vh] overflow-y-scroll row bg-white p-5 rounded-lg shadow-lg my-3 ">
        <div class="col-12 my-3 p-3 border-1">
            <div class="form-group">
                @if($respond)
                    <div class="text-md p-3 border-l-2 border-gray-200 flex">
                        <div class="w-10/12">
                            <p class="mb-4">{{$respond["user"]["name"]}}:</p>
                            <small>
                                {!!  (strlen($respond["message"]) > 50 ? substr($respond["message"], 0, 50) : $respond["message"])  !!}
                            </small>
                        </div>
                        <div class="w-2/12">
                            <button wire:click="resetMessage" type="submit" class="btn btn-danger bg-danger text-white">
                                <i class="far fa-times-circle"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
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
