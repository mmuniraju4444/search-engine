<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .container {
            padding-top: 5%;
        }

        #invalid, #result {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-auto">
            <p class="h1">Add Pages</p>
        </div>

        <form onsubmit="return submitForm()">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Add URL's of the Page</label>
                <textarea class="form-control" id="urls" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        <div id="result" class="alert alert-success d-none" role="alert">

        </div>

        <div id="invalid" class="alert alert-danger d-none" role="alert">
            <h4>Invalid URL</h4>
            <ul id="invalid-url">

            </ul>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
<script>
function submitForm(){
    event.preventDefault();
    let form = event.target;
    // let data = form.urls.split(',');
    let urls = form.urls.value.split(',')
    let validUrls = [];
    let invalidUrls = [];
    for(let url of urls) {
        url = url.trim();
        if(url.length === 0) {
            continue;
        }
        if(isURL(url)) {
            validUrls.push(url);
        } else {
            invalidUrls.push(url);
        }
    }
    let listEle = document.getElementById('invalid-url');
    listEle.innerHTML='';
    if(invalidUrls.length !== 0) {
        for (let url of invalidUrls) {
            let li = document.createElement('li')
            li.innerHTML = url;
            listEle.appendChild(li);
        }
        document.querySelector("#invalid").classList.remove('d-none')
    }
    if(validUrls.length !== 0) {
        sendUrls(validUrls);
    }
    return false;
}

function sendUrls(urls)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", 'api/pages');
    xmlhttp.responseType = 'json';
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('urls').value = '';
            document.querySelector("#result").innerHTML = this.response.msg;
            document.querySelector("#result").classList.remove('d-none')
        }
    };
    xmlhttp.send(JSON.stringify({urls:urls}));
}

function isURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return pattern.test(str);
}

</script>
</body>
</html>
