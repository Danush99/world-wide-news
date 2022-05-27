<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('partials.bootstrap')
    <title>Write..</title>
</head>
<body>
    <x-navigation>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="btn btn-secondary me-1" href="{{route('logout')}}"
               onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                Logout
            </a>
        </form>
    </x-navigation>

    <div class="p-2">
        <form method="post" action={{route('article.create')}} >
            @csrf
        <div class="row text-center">
            <div class="p-6 col-2 d-none d-md-inline d-lg-inline d-xxl-inline">
                <x-back-link/>
            </div>

            <div class="p-2 col-md-8" >
                <h2>Report Your News</h2>
            </div>

            <div class="p-2 col-md-2" id="publish-btn">
                <span>
                    <button class="btn btn-primary btn-sm" type="button" id="preview" >Preview</button>
                    <button class="btn btn-success btn-sm" type="submit">Publish</button>
                    <button class="btn btn-danger btn-sm" type="button">Discard</button>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-3 container" style="border-right:2px solid grey;">
                <h5 class="text-center">Your articles</h5>
                <br>
                <x-article.list-view headline="Ashesh tournament" status="Published"></x-article.list-view>
                <x-article.list-view headline="Barack Obama" status="Draft"></x-article.list-view>
                <x-article.list-view headline="Ashesh tournament" status="Pending"></x-article.list-view>
            </div>

            <div class="col-9 container">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select a category</label>
                        <select id="category" name="category" class="form-control">
                            <option value="Politics">Politics</option>
                            <option value="Sports">Sports</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Business">Business</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="headline">Headline</label>
                        <input class="form-control" type="text" name="headline" id="headline" placeholder="">
                    </div>
                    <div class="mb-3">

                        <x-form.tinymce label="Description" name="report" id="report"></x-form.tinymce>
                    </div>
                    <div class="mb-3">
                        <label for="media" class="form-label">Image</label>
                        <input type="file" name="media" id="media" class="form-control">
                    </div>
            </div>

        </div>
        </form>
    </div>

    <div id="dimmer" class="bg-opacity-75 bg-black d-none" style="position: fixed; top: 0; left: 0; z-index: 100;width: 100vw; height: 100vh">
        <div class="container bg-white rounded-2 mt-3" style="width: 60vw; height: 90vh;">
            <div  class="text-end fs-2">
                <span id="close-preview" style="cursor: pointer" >&Cross;</span>
                <p class="text-start fs-5" style="margin-top: 2rem;" id="preview-category"></p>
            </div>
            <div class="container overflow-auto mb-3" style="width: 100%; height: 100%">
                <h2 id="preview-headline" class="text-center"></h2>
                <div class="text-center">
                    <img id="preview-image" src="#" alt="image" width="200rem"/>
                </div>
                <div id="preview-report" class="container"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("preview").addEventListener('click', ()=>{
            const category = document.getElementById("category").value;
            const headline = document.getElementById("headline").value;
            const [image] = document.getElementById("media").files;
            const report = tinyMCE.activeEditor.getContent();
            document.getElementById("preview-category").innerText = category;
            document.getElementById("preview-headline").innerText = headline;
            document.getElementById("preview-image").src = URL.createObjectURL(image);
            document.getElementById("preview-report").innerHTML = report;
            document.getElementById("dimmer").classList.remove("d-none");
        });

        document.getElementById("close-preview").addEventListener('click',()=>{
            document.getElementById("dimmer").classList.add("d-none");
        })
    </script>
</body>
</html>
