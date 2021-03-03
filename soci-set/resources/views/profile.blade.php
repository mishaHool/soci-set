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
        <form action="main" method="get">
            <li><input type="submit" value="Move on main"></li>
        </form>
        <form action="profile" method="get">
            @csrf
            <input type="text" name="name" value="{{$vars['user'][0]['name']}}" style="display: none;">
            <li><input type="submit" value="Move to profile"></li>
        </form>
        <li>You make {{$vars['user'][0]['posts_count']}} posts</li>
        <li>You written {{$vars['user'][0]['comments_count']}} commentaries</li>
        <form action="/write-post" method="post">
            <input type="text" value="{{$vars['user'][0]['name']}}" name="name" id="" style="display: none;">
            <li><input type="submit" value="Write new post"></li>
        </form>
    </ul>
    </div>
    <div class="main-content">
        <div class="top-profile-bar">
            <div class="avatar">
                <img src="{{asset('img/Default.png')}}" class="default" alt="default-avatar">
                @if(array_key_exists('your_acc', $vars))
                    <!-- <form action="upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" value="{{$vars['user'][0]['name']}}" style="display: none;">
                        <input type="file" name="userfile" placeholder="none" id="">
                        <input type="submit" value="Change avatar">
                    </form> -->
                @endif
            </div>
            <div class="nick_name">{{$vars['user'][0]['name']}}</div>
        </div>
        <hr>
        <div class="posts-section">
        @if($vars['user'][0]['posts_count']==0)
            <div class="no-posts">You don't writed any post</div>
        @endif
        @if($vars['user'][0]['posts_count']>0)
        <h3>Your posts</h3>

            @for($i=0;$i!=count($vars['us_posts']);$i++)
                <div class="post-block">
                    <div class="title">{{$vars['us_posts'][$i]['title']}}</div>
                    <div class="category">{{$vars['us_posts'][$i]['category']}}</div>
                    <form action="read" method="get">
                        <input type="text" name="title" value="{{$vars['us_posts'][$i]['title']}}" style="display: none;">
                        <div class="btt_to_post"><input type="submit" value="Read Post"></div>
                    </form>
                </div>
            @endfor
        @endif
        </div>
    </div>
</body>
</html>