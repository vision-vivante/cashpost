@extends('frontend.default.layouts.app')
@section('content')
    <div class="find-job-detail chat-section">
        <section class="offer-detai-section">
            <div class="container">

                <div class="row border-top position-relative pb-5">
                    <div class="col-md-8 chat-side pt-5 border-0 shadow-none aiz-chat">
                        <div class="heading-chat">
                            <h2 class="font-weight-bold mb-3">{{$project->name}}</h2>
                           <!--  <h3 class="text-grey mb-5"> # {{$project->id}}</h3> -->
                        </div>
                        <div class="chatting border-top" >
                           
                            
                            <a href="javascript:void(0)" id="__firstChat" class="chat-user-item p-3 d-block text-inherit" data-url="{{ route('chat_view', $single_chat_thread->id) }}" data-refresh="{{ route('chat_refresh', $single_chat_thread->id) }}" onclick="loadChats(this)" style="visibility: hidden;">
                            </a>
                            <div id="single_chat"></div>
                            
                        </div>
                    </div>

                    @include('frontend.default.inc.chat_sidebar')

                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        function loadChats(el){
            // alert($(el).data('url'));
            $('.selected-chat').each(function() {
                $(this).removeClass('bg-soft-primary');
                $(this).removeClass('selected-chat');
            });

            $(el).addClass('selected-chat');
            $(el).addClass('bg-soft-primary');

            $.get($(el).data('url'),{}, function(data){
                console.log(data);
                $('#single_chat').html(data);
                AIZ.extra.scrollToBottom();

                initializeLoadMore();

                $('#send-mesaage').on('submit',function(e){
                    e.preventDefault();
                    send_reply();
                });
            });
        }
        setTimeout(function(){ $('#__firstChat').trigger('click');},300)
        function send_reply(){
            var chat_thread_id = $('#chat_thread_id').val();
            var message = $('#message').val();
            var attachment = $('#attachment').val();
            var proof = ($('#proof').is(':checked'))?1:0;            
            if(message.length > 0 || attachment.length > 0){
                $.post('{{ route('chat.reply') }}',{_token:'{{ csrf_token() }}', chat_thread_id:chat_thread_id, message:message, attachment:attachment,proof:proof}, function(data){
                    $('#message').val('');
                    $('#attachment').val('');
                    $('#chat-messages').append(data);
                    $('#proof').prop('checked',false);
                    AIZ.extra.scrollToBottom();
                });
            }
        }

        $(document).on('click','.chat-attachment',function(){
            AIZ.uploader.trigger(
                this,
                'direct',
                'all',
                '',
                true,
                function(files){
                    $('#attachment').val(files);
                    send_reply();
                }
            );
        });

        $(document).ready(function () {
            setInterval(function () {
                refreshChats();
            }, 5000);
        });

        function refreshChats(){
            var el = $('.selected-chat');
            $.get($(el).data('refresh'),{}, function(data){
                if (data.count > 0) {
                    $('#chat-messages').append(data.messages);
                    AIZ.extra.scrollToBottom();
                }
            });
        }

        function initializeLoadMore(){
            $('.load-more-btn').on('click', function(){
                $.post('{{ route('get-old-message') }}', {_token:'{{ csrf_token() }}', first_message_id:$(this).data('first')}, function(data){
                    if (data.first_message_id > 0) {
                        $('#chat-messages').prepend(data.messages);
                        $('.load-more-btn').data('first', data.first_message_id);
                    }
                });
            });
        }
        
    </script>
    <script type="text/javascript">
        function show_modal(){
            $('#project_submit').modal('show');
        }

        // $(document).on('ready',function(){
			$('textarea#message').emoji({place: 'after'});
		// })
        function disputed_modal(){
           $('#disputed_for_project').modal('show');
        }
        $('form#disputed_form').submit(function(){
            $(this).find(':input[type=submit]').prop('disabled', true);
        });
            setTimeout(() => {
			    $('textarea#message').emoji(
                    {
                        button:'<i class="bi bi-emoji-smile"></i>',
                        place: 'after',
                        listCSS:{position: 'absolute',bottom:'50px', border: '1px solid gray', 'background-color': '#fff', display: 'none'}
                    }
                );                
            }, 500);

    </script>
@endpush
