@extends('layout.app')
@section('title')
Gallery | Admin
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <button id="addNewImageButton" class="btn btn-danger m-3 ml-0" >Add New</button>

        </div>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 p-1">
                    <div class="gallery-thumbnail-container border-rounded">
                        <img class="gallery-thumbnail-image" src="{{$image->image_link}}" alt="{{$image->image_caption}}">
                        <div class="gallery-thumbnail-hover">
                            <p class="gallery-thumbnail-title">{{$image->image_caption}}</p>
                            <button onclick="ZoomView">View</button>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col">
            <!-- New Image Add Modal -->
            <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Add Image</h5>
                    <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div id="imageInputForm">
                            <input id="imageInput" class="form-control p-1 bg-info" type="file"  accept="image/*" required>
                            <input id="imageCaption" class="form-control p-1" type="text" placeholder="Enter Image Caption">
                            <img id="imagePreview" class="w-100" src="" alt="">
                        </div>
                        <h5 id='addImageFail' class="text-danger d-none">Something went wrong</h5>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addImageConfirmationButton" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </div>
            </div>    <!-- End Image Add Modal -->

        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
$(document).on('click', '#addNewImageButton', function(){
    $('#addImageModal').modal('show');
})
$('#imageInput').change(function(){
    let reader = new FileReader();
    reader.readAsDataURL(this.files[0])

    reader.onload = function(event){
        let imageSource = event.target.result;
        $('#imagePreview').attr('src', imageSource);
        $('#imagePreview').attr('alt', 'Select Image');
    }
})

    $('#addImageConfirmationButton').on('click', function(){
        $(this).html("<div class='spinner-border text-light' role='status'></div>");
        let imageFile=$('#imageInput').prop('files')[0];
        let formData = new FormData();
        formData.append('image', imageFile);
        let caption = $('#imageCaption').val();
        if(caption){
            formData.append('image_caption', caption)
        }
        axios.post('/saveImage', formData).then(function(response){
            if(response.status=200){
                if(response.data==1){
                    toastr.success('Image saved successfully!');
                    $('#addImageModal').modal('hide');
                    $('#imagePreview').attr('src', '');
                    $('#imageInput').val('');
                    $('#imageCaption').val('');
                }else{
                    toastr.error('Saved Failed! Try again!');
                }
            }else{
                toastr.error('Somethin went wrong! Try again!');
            }
            $('#addImageConfirmationButton').html('Save');
        }).catch(function(error){
            toastr.error(error.message);
            $('#addImageConfirmationButton').html('Save');
            console.log(error);
        });
    });


</script>
    
@endsection