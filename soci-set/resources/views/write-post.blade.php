<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="write-content">
        <form action="add-post" method="post">
            @csrf
            <input type="text" name="title" id="" placeholder="TITLE">
            <textarea name="text" id="" cols="30" rows="10">

            </textarea>
            Select category:
            <select name="category" id="">
                <option value="Games">Games</option>
                <option value="Technologies">Tech</option>
                <option value="Cooking">Cooking</option>
                <option value="News">News</option>
            </select>
            <input type="text" name="author" value="{{$author[0]['name']}}" style="display: none;" id="">
            <input type="submit" value="Add post">
            @if(!empty($err))
                {{$err}}
            @endif
        </form>
    </div>
</body>
</html>