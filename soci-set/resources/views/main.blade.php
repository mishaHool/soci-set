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
    <div class="top-bar">
    <ul>
        <form action="profile" method="get">
            @csrf
            <input type="text" name="name" value="{{$vars['users'][0]['name']}}" style="display: none;">
            <li><input type="submit" value="Move to profile"></li>
        </form>
        <li>You make {{$vars['users'][0]['posts_count']}} posts</li>
        <li>You written {{$vars['users'][0]['comments_count']}} commentaries</li>
        <form action="/write-post" method="get">
            <input type="text" value="{{$vars['users'][0]['name']}}" name="name" id="" style="display: none;">
            <li><input type="submit" value="Write new post"></li>
        </form>
    </ul>
    </div>
    <div class="filters">
        Filters
        <form action="/main" method="get">
            Select category
            <select name="filters" id="">
                <option value="no"></option>
                <option value="games">Games</option>
                <option value="tech">Tech</option>
                <option value="cooking">Cooking</option>
                <option value="news">News</option>            
            </select>
            Seek by author
            <input type="text" name='author' placeholder='Enter author name'>
            <p><input type="checkbox" name="disable" value="true"  id="">Disable filters</p>
            <input type="submit" value='use filters'>
        </form>
    </div>
    <div class="main-content">
    <div class="posts">
        @if(count($vars['posts'])==0)
            <h2>There are any post</h2>
        @else
            @for($i=0;$i!=count($vars['posts']);$i++)
                <div class="post-block">
                    <div class="title">{{$vars['posts'][$i]['title']}}</div>
                    <div class="short_text">{{$vars['posts'][$i]['short_text']}}...</div>
                    <div class="category">{{$vars['posts'][$i]['category']}}</div>
                    <div class="author">By {{$vars['posts'][$i]['author']}}</div>
                    <form action="read" method="get">
                        <input type="text" name="title" value="{{$vars['posts'][$i]['title']}}" style="display: none;">
                        <div class="btt_to_post"><input type="submit" value="Read Post"></div>
                    </form>
                </div>
            @endfor
        @endif
    </div>
    </div>
</body>
</html>