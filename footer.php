<?php
if (!$mobileLayout) echo '<a href="#" onclick="enableMobileLayout(1); return false;" rel="nofollow">Mobile view</a>';
else echo '<a href="#" onclick="enableMobileLayout(-1); return false;" rel="nofollow">Disable mobile view</a>';
?>
<br>
<br>
<?php $bucket = "footer"; include("./lib/pluginloader.php");?>
Powered by AcmlmBoard XD - version 3.0+&#937;<br />
By Dirbaio, xfix, Kawa, StapleButter, Nina, et al<br />
AcmlmBoard &copy; Jean-Fran&ccedil;ois Lapointe<br />
<?php print __("<!-- English translation by The ABXD Team -->")?>
<a href="http://validator.w3.org/check?uri=referer">
	<img src="img/xhtml10.png" alt="Valid XHTML 1.0 Transitional" />
</a>
<a href="http://jigsaw.w3.org/css-validator/">
	<img src="img/css.png" alt="Valid CSS!" />
</a>
<a href="https://github.com/timekiller89/ABXD-Omega">
	<img src="img/getabxd.png" alt="Get a copy for yourself" />
</a>
<?php print (isset($footerButtons) ? $footerButtons : "")?>
<?php print (isset($footerExtensionsB) ? $footerExtensionsB : "")?>
