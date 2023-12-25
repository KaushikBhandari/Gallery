@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
</head>
<body>
@section('content')
<div class="backdrop">
<div class="d-flex">

<div class="collapse" id="collapsewindow">
  <div class="card-body" style="max-height:500px";>

  <div class="up-screen">
  <form id="formm" action="store_data" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
    @csrf
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label fs-4">File name</label>
    <input type="text" name="filename" class="form-control" id="validationCustom01" value="Image" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom04" class="form-label fs-4">Category</label>
    <select class="form-select" name="category" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>Family</option>
      <option>Friends</option>
      <option>Personel</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid Category.
    </div>
  </div>
  
  <label for="input-file" id="drop-area">
            <input type="file" name="image" accept="image/*" id="input-file" hidden>
            <div id="img-view">
                <img class="icon" src="icon.png">
                <p>Drag and Drop or Click here<br> to Upload</p>
                <span>Upload any images from desktop</span>
            </div>
        </label>
        <div class="col-12">
    <button class="btn btn-primary cursor-pointer sub-btn" type="submit">Submit</button>
  </div>
</form>
        
</div>
    </div>
    
</div>
</div>
<div class="bg-gallery" >
  
<link rel="stylesheet" href="{{ asset('lightbox.css') }}">
@foreach($imgdata as $photo)
   <div class="gallery">
        <a href="public/photos/{{$photo->image}}" data-lightbox="photos" data-title="{{$photo->filename}}">
        <img src="public/photos/{{$photo->image}}">
        </a>
        <form action="{{ url('deleteImage/' .$photo->id) }}" method="post" class="delete-img">
        @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
            </form>
        
        
        <script src="{{ asset('lightbox-plus-jquery.js') }}"></script>
    </div>
    @endforeach
</div>
</div>
</body>
</html>
@endsection('content')

@section('js')

<script type="text/javascript">
const dropArea = document.getElementById("drop-area")
const inputFile = document.getElementById("input-file")
const imgView = document.getElementById("img-view")

inputFile.addEventListener("change", uploadImage)

function uploadImage() {
    
    let imgLink = URL.createObjectURL(inputFile.files[0])

    imgView.style.backgroundImage = `url(${imgLink})`
    imgView.textContent = ''
    imgView.style.border =0
}

dropArea.addEventListener('dragover', function(e){
    e.preventDefault()
})
dropArea.addEventListener('drop', function(e){
    e.preventDefault()
    inputFile.files = e.dataTransfer.files
    uploadImage()
})
function toggleButtonText() {
  var uploadBtn = document.getElementById('uploadBtn');

  
  if (uploadBtn.textContent === 'Close') {
    
    uploadBtn.textContent = 'Upload';
  } else {
    
    uploadBtn.textContent = 'Close';
  }
}
</script>
@endsection('js')