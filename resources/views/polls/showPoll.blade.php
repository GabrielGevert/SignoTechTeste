<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
<x-app-layout>
    <div class="container">
        <h1 class="h1-style">{{$poll->title}}</h1>
        <h3 class="h3-style">Termina {{$poll->EndDateFormat}}</h3>
        <form action="" method="post">
            @csrf

            @foreach($poll->options as $option)
            <div class="options">
                <div class="option">
                    <input type="radio" id="option1" name="option" value="{{$option->id}}">
                    <span">{{$option->content}}</span>
                </div>
            </div>
            @endforeach
            <div style="text-align: center;">
                <button class="button-style" type="submit">Votar</button>
            </div>
        </form>
    </div>
</x-app-layout>
</body>
</html>
