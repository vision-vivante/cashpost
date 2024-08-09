<!-- cancel Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content apply-model">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                </button>

            </div>
            <div class="modal-body" id="content_for_modal_body">
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            var $videoSrc;  
            $('.video-btn').click(function() {
                $videoSrc = $(this).data( "src");
                $('#myModal').modal('show');
                var type = $(this).data( "type");
                if(type=='Video'){
                    //$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
                    var src=$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0";
                    $("#content_for_modal_body").html('<iframe class="embed-responsive-item" src="'+src+'" id="video"  allowscriptaccess="always" allow="autoplay" style="width:100%; height:400px;" ></iframe>'); 
                }else{
                    $('#content_for_modal_body').html('<img class="document" src="'+$videoSrc+'" style="width:100%; height:400px;"/>')
                }
            });
        });


         $(document).on('click', '[data-dismiss="modal"]', function(){

             $('iframe').contents().find('video')[0].pause();
        })
    
       
    </script>
