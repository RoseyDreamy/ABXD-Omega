<?php

//$user['postheader'] = "";
//$user['signature'] = "";
if($loguserid)
	$user = $loguser;
else
{
	$user = Fetch(Query("select * from {users} where id=1"));
	Alert("You are not logged in. The test page will be displayed using ".$user['name']."'s layout and statistics.");
}

$preview =
"Regular text.
One break

Two breaks
Sentence with a<br />HTML BR tag inbetween

[b]BB Bold[/b], [i]BB Italic[/i], <strong>HTML Strong</strong>, <em>HTML Emphasis</em>, <b>HTML Bold</b>, <u>HTML Underline</u> (should become a styled span), [s]BB Strikethrough[/s] and <del>HTML Deleted</del>.

&lt;tag> with the opening bracket escaped

/me does an IRC action

[url]http://rosey.78.lt[/url]
[url=http://rosey.78.lt]Titled URL[/url]
[img]data/avatars/1[/img]

<span style=\"display: none\">If you can see this line, \"display:\" is filtered into nonfunctionality.</span>

<script>alert(\"Scripts should be filtered.\");</script>

[quote]Quote block[quote][quote][quote]Sub-quote[/quote]Sub-quote[/quote]Sub-quote[/quote][/quote]
[quote=Ryuzaki]Quote with attribution[/quote]
[quote=\"Ryuzaki\" id=\"52\"]Quote with attribution and link[/quote]
[reply=\"Ryuzaki\"]Reply, attribution and link mandatory.[/reply]

[code]BB Code
Second line
<tag> in the middle

Fifth line, after empty fourth[/code]

<pre>HTML Pre tag
  Second line, has two spaces.
<tag> in the middle, tag should not be visible, leaving one space.

Fifth line, after empty fourth
	Sixth line, after tab (probably 8 characters, starting at the 'n' in \"line\")</pre>

HTML Pre tag around a BB Code:
<pre>[code]".'//Smilies
if(!$noSmilies)
{
	for($i = 0; $i < count($smilies); $i++)
		$s = str_replace($smilies[$i][\'code\'], "«".$smilies[$i][\'image\']."»", $s);
	for($i = 0; $i < count($smilies); $i++)
		$s = str_replace("«".$smilies[$i][\'image\']."»", "<img src=\\\"img/smilies/".$smilies[$i][\'image\'].
			"\\\" alt=\\\"".$smilies[$i][\'code\']."\\\" />", $s);
}'."[/code]</pre>

GeSHi colorcoding (Only available if plugin is enabled):
[source]void Function()
{
  Console.Write(\"No language given, C# assumed.\");
  someVar += 2;
  // Note that this introduces several new CSS classes:
  // .geshi      main block -- all others are below this: \".geshi .kw0\"
  // .kw0 to 4   several kinds of keywords
  // .st0        string literals
  // .nu0        number literals
  // .br0        brackets
  // .sy0        operators and such
  // .co1        comments
}[/source]
[source=C]void Function()
{
  printf(\"This is plain C.\");
  someVar += 2;
}[/source]
[source=html4strict]<p>
  This is a paragraph.
  This is <b>bold</b>
</p>[/source]

Linebreak type tests:
\\r\\n \r\n Should have a break
\\n        \n Should have a break
\\r      \r   Should not break

Single spoiler: [spoiler]This is a spoiler.[/spoiler]
Double spoiler: [spoiler]This is a spoiler [spoiler]containing another spoiler[/spoiler] which may not work properly[/spoiler]
Spoiler in a quote: [quote=Ryuzaki][spoiler]I'm L.[/spoiler][/quote]

Now, for the table stuff!
HTML table:
<table>
	<tr>
		<td>1</td>
		<td>2</td>
	</tr>
	<tr>
		<td>3</td>
		<td>4</td>
	</tr>
</table>

HTML table without closing td and tr's:
<table>
	<tr>
		<td>1
		<td>2
	<tr>
		<td>3
		<td>4
</table>

BBCode table, first row is header:
[table]
	[trh]
		[td]1[/td]
		[td]2[/td]
	[/trh]
	[tr]
		[td]3[/td]
		[td]4[/td]
	[/tr]
[/table]

BBCode table without closing td, tr and trh:
[table]
	[trh]
		[td]1
		[td]2
	[tr]
		[td]3
		[td]4
[/table]

Youtube embed:
[youtube]2Z4m4lnjxkY[/youtube]

Video tag:
[video]http://camoy.sdf.org/files/vid/trololo.mp4[/video]

Flash tag:
[swf 300 200]http://twilightro.kafuka.org/~blackhole89/internets/lolinternet.swf[/swf]

";

$previewPost['text'] = $preview;

$previewPost['num'] = "_";
$previewPost['id'] = "_";

foreach($user as $key => $value)
	$previewPost["u_".$key] = $value;

MakePost($previewPost, POST_SAMPLE);

?>