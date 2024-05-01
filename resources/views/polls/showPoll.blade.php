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
        <h1>{{$poll->title}}</h1>
        <form action="" method="post">
            @csrf
            <div class="options">
                <div class="option">
                    <input type="radio" id="option1" name="option" value="1">
                    <label for="option1">Opção 1</label>
                </div>
                <div class="option">
                    <input type="radio" id="option2" name="option" value="2">
                    <label for="option2">Opção 2</label>
                </div>
                <div class="option">
                    <input type="radio" id="option3" name="option" value="3">
                    <label for="option3">Opção 3</label>
                </div>
            </div>
            <div style="text-align: center;">
                <button class="button-style" type="submit">Votar</button>
            </div>
        </form>
    </div>
</x-app-layout>
</body>
</html>
