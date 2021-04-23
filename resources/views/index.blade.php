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

        .card-title {
            color: #00a6ff;
        }

        .pagination-area {
            padding-top: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-auto">
            <p class="h1">Search Engine</p>
        </div>
    </div>
    @if ($totalPage != 0)
    <div class="row justify-content-md-center search-area">
        <div class="col">
            <div class="input-group mb-3">
                <input id="search-text" type="text" class="form-control form-control-lg" placeholder="Search"
                       aria-label="Search KeyWord" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary search-button" type="button" id="button-addon2">Search</button>
            </div>
        </div>
    </div>
    <div class="result" id="result-area">

    </div>
    <div class="row justify-content-md-center pagination-area">
        <div class="col-auto">
            <nav aria-label="...">
                <ul id="pagination" class="pagination pagination-sm">
                </ul>
            </nav>
        </div>
    </div>
    @else
        <div class="row justify-content-md-center search-area">
            <div class="col-auto">
                <div class="input-group mb-3">
                    No Pages Crawled
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center search-area">
            <div class="col-auto">
                <div class="input-group mb-3">
                    <a class="btn btn-primary" href="/add-pages" role="button">Add Pages</a>
                </div>
            </div>
        </div>
    @endif
    <div>
        <div class="row justify-content-md-center d-none" id="result-template">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="link" href="#"></a>
                        </h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
        <li id="page-item-template" class="page-item d-none">
            <span class="page-link"></span>
        </li>
        <input id="current-page" type="hidden" value="1">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.search-button').addEventListener('click', function (event) {
            let q = document.getElementById('search-text').value.trim();
            let currentPage = document.getElementById('current-page').value.trim();
            if (q.length == 0) {
                return;
            } else {
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.responseType = 'json';
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        let data = this.response.data;
                        processResult(data);
                        renderPagination(this.response.links);
                        attachEvent()
                    }
                };
                xmlhttp.open("GET", "api/pages?q=" + q + "&page=" + currentPage, true);
                xmlhttp.send();
            }
        });
    }, false);

    function attachEvent() {
        let elements = document.getElementsByClassName("page-item");

        for (let i = 0; i < elements.length; i++) {
            elements[i].onclick = function () {
                console.log(this);
                let link = this.querySelector('.page-link');
                document.getElementById('current-page').value = link.innerHTML;
                document.querySelector('.search-button').click();
            }
        }
    }

    function renderPagination(links) {
        document.getElementById('pagination').innerHTML = '';
        for (let link of links) {
            let pageNo = parseInt(link.label);
            if (Number.isInteger(pageNo)) {
                let template = getPaginationTemplate();
                if (link.active) {
                    template.classList.add("active");
                }
                let title = template.querySelector('.page-link');
                title.innerHTML = link.label;
                document.getElementById('pagination').appendChild(template);
            }
        }
    }

    function getPaginationTemplate() {
        let nodeEle = document.querySelector("#page-item-template");
        let node = nodeEle.cloneNode(true);
        node.setAttribute('id', '');
        node.classList.remove('d-none')
        return node;
    }

    function processResult(data) {
        if (Array.isArray(data) == true) {
            document.getElementById('result-area').innerHTML = '';
            for (let row of data) {
                let template = getTemplate();
                let title = template.querySelector('.link');
                let data = template.querySelector('.card-text');
                title.setAttribute('href', row.url);
                title.innerText = row.title;
                data.innerText = row.data;
                document.getElementById('result-area').appendChild(template);
            }
        }
    }

    function getTemplate() {
        let nodeEle = document.querySelector("#result-template");
        let node = nodeEle.cloneNode(true);
        node.setAttribute('id', '');
        node.classList.remove('d-none')
        return node;
    }
</script>
</body>
</html>
