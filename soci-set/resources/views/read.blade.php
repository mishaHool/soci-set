<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Document</title>
</head>
<body>
<div class="top-bar">
    <ul>
        <form action="main" method="get">
            <li><input type="submit" value="Move on main"></li>
        </form>
        <form action="profile" method="get">
            @csrf
            <input type="text" name="name" value="{{$render['top'][0]['name']}}" style="display: none;">
            <li><input type="submit" value="Move to profile"></li>
        </form>
        <li>You make {{$render['top'][0]['posts_count']}} posts</li>
        <li>You written {{$render['top'][0]['comments_count']}} commentaries</li>
        <form action="/write-post" method="post">
            <input type="text" value="{{$render['top'][0]['name']}}" name="name" id="" style="display: none;">
            <li><input type="submit" value="Write new post"></li>
        </form>
    </ul>
</div>
    <div class="main-content">
        <div class="render_title"><h2>{{$render['render'][0]['title']}}</h2></div>
        <div class="one-block">        
            <form action="profile" method="get">    
                <input type="text" name="name" value="{{$render['render'][0]['author']}}" style="display: none;">
                <div class="render_author"><input type="submit" value="{{$render['render'][0]['author']}}"></div>
            </form>
            <div class="render_category">{{$render['render'][0]['category']}}</div>
            <div class="render_date">{{$render['render'][0]['created_at']}}</div>
        </div>
        <div class="render_text">{{$render['render'][0]['text']}}</div>
        <div class="comments">
            <form action="/add-comment" class="commentary" method="post">
                @csrf
                    <input type="text" value="{{$render['top'][0]['name']}}" style="display: none;" name="author">
                    <input type="text" value="{{$render['render'][0]['id']}}" style="display: none;" name="post_id">
                    <input type="text" name='text' placeholder="enter commentary text">
                    <input type="submit" value="Add commentary">
            </form>
            <div class="comments_render">
                @if(!$render['comment'])
                    <h4>There are any comment</h4>
                @else
                    @for($i=0;$i!=count($render['comment']);$i++)
                        <div class="comment_section">
                            <div class="author_comment">{{$render['comment'][$i]['author']}}</div>
                            <div class="text_comment">{{$render['comment'][$i]['text']}}</div>
                            <div class="date_comment">{{$render['comment'][$i]['created_at']}}</div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

</body>
</html>