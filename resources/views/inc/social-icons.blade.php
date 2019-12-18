<?php

$url = urlencode(url()->full());
$title = urlencode($poll->title);

$facebook = "https://www.facebook.com/sharer/sharer.php?u=$url";
$pinterest = "http://pinterest.com/pin/create/button/?url=$url";
$reddit = "http://www.reddit.com/submit?url=$url&title=$title";
$twitter = "https://twitter.com/intent/tweet?text=$url";
$vk = "http://vk.com/share.php?url=$url&title=$title&comment=$title";
?>
<a href="{{ $facebook }}" target="_blank" class="btn-social btn-facebook"><i class="fa fa-facebook"></i></a>
<a href="{{ $pinterest }}" target="_blank" class="btn-social btn-pinterest"><i class="fa fa-pinterest"></i></a>
<a href="{{ $reddit }}" target="_blank" class="btn-social btn-reddit"><i class="fa fa-reddit"></i></a>
<a href="{{ $twitter }}" target="_blank" class="btn-social btn-twitter"><i class="fa fa-twitter"></i></a>
<a href="{{ $vk }}" target="_blank" class="btn-social btn-vk"><i class="fa fa-vk"></i></a>
