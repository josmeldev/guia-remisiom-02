@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row position-relative">
        <div class="col-md-9">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Pariatur, earum facilis reprehenderit ex expedita, accusantium veniam laudantium praesentium excepturi officia, ea sit consectetur blanditiis impedit eos nam. Fugit, aliquid magnam.
        </div>
        <div class="col-md-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum nobis sequi sunt nisi vitae deleniti obcaecati minus cumque molestias suscipit totam neque quibusdam hic quaerat labore velit, facere officiis explicabo.
        </div>
        <div class="col-md-3 hidden-content" id="hiddenContent">
            Este porfavor quiero que se traslade derecha a izquierda para mostrarse sin desbordar su contenedor
        </div>
    </div>

</div>



@endsection
