	<meta http-equiv="Content-Type" content="text/html; CHARSET=utf-8" />
	<meta name="description" content="<?php print Settings::get('metaDescription'); ?>" />
	<meta name="keywords" content="<?php print Settings::get('metaTags'); ?>" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $layout_favicon;?>" />
	<link rel="stylesheet" type="text/css" href="<?php print resourceLink("css/common.css");?>" />
	<link rel="stylesheet" type="text/css" href="<?php print resourceLink("js/spectrum.css");?>" />
	<link rel="stylesheet" href="<?php print resourceLink("css/font-awesome.min.css");?>">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	
	<script type="text/javascript" src="<?php print resourceLink("js/jquery.js");?>"></script>
	<script type="text/javascript" src="<?php print resourceLink("js/tricks.js");?>"></script>
	<script type="text/javascript" src="<?php print resourceLink("js/jquery.tablednd_0_5.js");?>"></script>
	<script type="text/javascript" src="<?php print resourceLink("js/jquery.scrollTo-1.4.2-min.js");?>"></script>
	<script type="text/javascript" src="<?php print resourceLink("js/spectrum.js");?>"></script>
<script>
    (function(document,navigator,standalone) {
        // prevents links from apps from oppening in mobile safari
        // this javascript must be the first script in your <head>
        if ((standalone in navigator) && navigator[standalone]) {
            var curnode, location=document.location, stop=/^(a|html)$/i;
            document.addEventListener('click', function(e) {
                curnode=e.target;
                while (!(stop).test(curnode.nodeName)) {
                    curnode=curnode.parentNode;
                }
                // Conditions to do this only on links to your own app
                // if you want all links, use if('href' in curnode) instead.
                if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                    e.preventDefault();
                    location.href = curnode.href;
                }
            },false);
        }
    })(document,window.navigator,'standalone');
</script>
	<script type="text/javascript">
		boardroot = <?php print json_encode($boardroot); ?>;
	</script>

	<?php
		if(file_exists("layouts/$layout/style.css"))
			echo '<link rel="stylesheet" href="'.resourceLink("layouts/$layout/style.css").'" type="text/css" />';
		if(file_exists("layouts/$layout/script.js"))
			echo '<script type="text/javascript" src="'.resourceLink("layouts/$layout/script.js").'"></script>';
	?>
	<link rel="stylesheet" type="text/css" id="theme_css" href="<?php print resourceLink($layout_themefile); ?>" />

	<?php
		$bucket = "pageHeader"; include("./lib/pluginloader.php");
	?>
