<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
        
            <title>{{ config('app.name', 'Evetrine') }}</title>
        
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <!-- pagination script-->   
            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
            $(document).ready(function()
            {
                var totalRows = $('#tblData').find('tbody tr:has(td)').length;
                var recordPerPage = 4;
                var totalPages = Math.ceil(totalRows / recordPerPage);
                var $pages = $('<ul class="pagination pagination-lg align-items-end">');
                for (i = 0; i < totalPages; i++)
                {
                    $('<li class="page-item"><a class="page-link" href="#">' + (i + 1) + '</a></li>').appendTo($pages);
                }
                $pages.appendTo('#CardsHolder');

                $('table').find('tbody tr:has(td)').hide();
                var tr = $('table tbody tr:has(td)');
                for (var i = 0; i <= recordPerPage - 1; i++)
                {
                    $(tr[i]).show();
                }
                $('a').click(function(event)
                {
                    $('#tblData').find('tbody tr:has(td)').hide();
                    var nBegin = ($(this).text() - 1) * recordPerPage;
                    var nEnd = $(this).text() * recordPerPage - 1;
                    for (var i = nBegin; i <= nEnd; i++)
                    {
                        $(tr[i]).show();
                    }
                });
            });

        </script>
        </head>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .parent 
            {
                display: flex;
                flex-wrap: wrap;
            }

            .child 
            {
                flex: 1 0 21%; /* explanation below */
                margin: 5px;
                height: 100%;
            }
            .page-link
            {
                background-color: coral;
                color: #fff;
                cursor: pointer;
                font-weight: bold;
                
            }
            .page-link:hover
            {
                background-color: #fff;
                color: coral;
            }
            .page-link:focus , .page-link:active
            {
                background-color: #fff;
                color: coral;
                outline: none;
                -moz-outline-style: none;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/admin') }}">Administration</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title mx-auto" style="color: coral;width:100%; margin-top:10%">
                    Evetrine
                </div>
                <div id="CardsHolder" style="display: flex; flex-direction:column; align-items: center;">
                    @if($articles->count()>0)
                    <table id="tblData" class="row d-flex flex-md-wrap">
                        @foreach($articles as $article)
                            <tr style="display: inline">
                                <td>
                                    <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem; font-size: 105%; hover:shad">
                                        <div class="card-body" style="height: 250px;">
                                            <div class="card-header">
                                                <h5 class="card-title">{{$article->title}}</h5>
                                            </div>
                                            <p class="card-text">{{$article->description}}</p>
                                            <div class="card-footer text-muted" style="background:#ffe6dd">
                                                Category : <span style="font-weight: bold; color: #ef1981">{{$article->category->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <div class="alert alert-warning" role="alert">
                            No articles yet!
                        </div>        
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
