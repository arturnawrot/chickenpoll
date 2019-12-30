<?php
    $image = asset('images/web.png');
    if(isset($poll->thumbnail)) {
        $image = asset($poll->thumbnail->path);
    }
?>

<meta property="og:title" content="{{ $title }}"/>
<meta property="og:site_name" content="{{ $description }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:image" content="{{ $image }}" />
<meta name="title" content="{{ $title }}" />
<meta name="type" content="website" />
<meta name="url" content="{{ url()->full() }}" />
<meta name="description" content="{{ $description }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@PollChicken" />
<meta name="twitter:creator" content="@PollChicken" />
<meta name="twitter:title" content="{{ $title }}" />
<meta name="twitter:description" content="{{ $description }}" />
<meta name="twitter:image" content="{{ $image }}" />