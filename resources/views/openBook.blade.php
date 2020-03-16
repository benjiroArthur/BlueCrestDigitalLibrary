<!DOCTYPE html>
<html>
<head>

    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/mdi/css/materialdesignicons.css') }}" rel="stylesheet">
</head>
<body>
<div class="top-bar">
    <button class="btn" id="pre-page">
        <i class="mdi mdi-arrow-left-circle"></i> Prev Page
    </button>
    <button class="btn" id="next-page">
        Next Page <i class="mdi mdi-arrow-right-circle"></i>
    </button>
    <span class="page-info">
         Page <span id="page-num"></span> of <span id="page-count"></span>
    </span>
</div>
<canvas id="pdf-render">

</canvas>
<input id="file" value="{{$file}}" hidden="hidden">

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.2.228/build/pdf.min.js"></script>
{{--<script src="{{ asset('js/pdf.js') }}" defer></script>--}}
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{asset('js/script.js')}}"></script>
<script>

    $(document).ready(function(){
        const url = $('#file').val();
        let pdfDoc = null,
            pageNum = 1,
            pageIsRendering = false,
            pageNumIsPending = null;

        const scale = 1.5,
            canvas = document.querySelector('#pdf-render'),
            ctx = canvas.getContext('2d');

        //Render the page
        const renderPage = num =>{};

        //get Document
        pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
            pdfDoc = pdfDoc_;
            console.log(pdfDoc);
        })


    });

</script>
</body>
</html>