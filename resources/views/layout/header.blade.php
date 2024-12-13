<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .empty{
            width: 100%;
            height: 3vmax;
        }
        .empty1_5{
            width: 100%;
            height: 1.5vmax;
        }
        #see_form_1{
            cursor: pointer;
        }
        #background_modal{
            display: none;
            /* flex-direction: column; */
            align-items: center;
            justify-content: center;
            position: absolute;
            z-index: 2;
            width: 100vmax;
            height: 45.55vmax;
            background-color: rgba(170, 170, 170, 0.4);
        }
        #div_form{
            border-radius: 1vmax;
            padding: 2vmax;
            background-color: white;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        
    </style>
</head>
<body>
<div id="background_modal"></div>

    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Query-Builder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    
                </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

</body>
</html>