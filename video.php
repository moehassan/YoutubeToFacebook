<?php
/*
    The MIT License (MIT)

    Copyright (c) 2016 moehassan (moe@moehassan.com)

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
*/

/* SETTINGS */
$twitter_username= '@moehassan'; #Change to your twitter username


/* ###################################################################### */
/** PLEASE DON'T EDIT BELOW THESE LINES UNLESS YOU KNOW WHAT YOU'RE DOING **/

$video_id = (isset($_GET['v'])?$_GET['v']:false);
if(!$video_id) exit('ERROR - VIDEO ID IS MISSING - e.g. video.php?v=ABCXYZ');

function get_youtube_video($video_id){
    $youtube = "http://www.youtube.com/oembed?url=https://youtu.be/". $video_id ."&format=json";
    $curl = curl_init($youtube);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return json_decode($return, true);
}

$video = get_youtube_video($video_id);
if(!$video) exit('ERROR - INVALID VIDEO ID');
?>

<html>
    <head>
        <title><?php echo $video['title'] ?></title>
        <meta name="description" content="<?php echo $video['title'] ?>"/>
        <meta itemprop="name" content="<?php echo $video['title'] ?>">
        <meta itemprop="description" content="<?php echo $video['title'] ?>">
        <meta itemprop="image" content="<?php echo $video['thumbnail_url'] ?>">


        <meta property="og:title" content="<?php echo $video['title'] ?>"/>
        <meta property="og:description" content="<?php echo $video['title'] ?>"/>
        <meta property="og:image" content="<?php echo $video['thumbnail_url'] ?>"/>
        <meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'] ?>"/>


        <meta property='og:video' content='https://youtu.be/<?php echo $video_id ?>'/>
        <meta property='og:video:height' content='<?php echo $video['width'] ?>'/>
        <meta property='og:video:type' content='application/x-shockwave-flash'/>
        <meta property='og:video:width' content='<?php echo $video['height'] ?>'/>
        <meta property='og:type' content='video'/>


        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="<?php echo $twitter_username ?>" />
        <meta name="twitter:title" content="<?php echo $video['title'] ?>" />
        <meta name="twitter:description" content="<?php echo $video['title'] ?>" />
        <meta name="twitter:description" content="<?php echo $video['title'] ?>" />
        <meta name="twitter:image" content="<?php echo $video['thumbnail_url'] ?>" />

        <meta name="viewport" content="width=<?php echo $video['width'] ?>, initial-scale=1">
    </head>
    <body>
        <h1><?php echo $video['title'] ?></h1>
        <img src="<?php echo $video['thumbnail_url'] ?>" style="display: none;"/>
        <iframe width="100%" height="90%" src="https://www.youtube.com/embed/<?php echo $video_id ?>?rel=0" frameborder="0" allowfullscreen></iframe>
        <img src="<?php echo $video['thumbnail_url'] ?>" style="display: none;"/>
    </body>
</html>