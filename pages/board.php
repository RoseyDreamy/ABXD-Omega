<?php

if($loguserid && isset($_GET['action']) && $_GET['action'] == "markallread")
{
	Query("REPLACE INTO {threadsread} (id,thread,date) SELECT {0}, {threads}.id, {1} FROM {threads}", $loguserid, time());
	redirectAction("board");
}

$links = new PipeMenu();
if ($loguserid)
	$links->add(new PipeMenuLinkEntry(__("Mark all forums read"), "board", 0, "action=markallread", "ok"));

makeLinks($links);
makeBreadcrumbs(new PipeMenu());

if(!$mobileLayout)
{
	$statData = Fetch(Query("SELECT
		(SELECT COUNT(*) FROM {threads}) AS numThreads,
		(SELECT COUNT(*) FROM {posts}) AS numPosts,
		(SELECT COUNT(*) FROM {users}) AS numUsers,
		(select count(*) from {posts} where date > {0}) AS newToday,
		(select count(*) from {posts} where date > {1}) AS newLastHour,
		(select count(*) from {users} where lastposttime > {2}) AS numActive",
		 time() - 86400, time() - 3600, time() - 2592000));

	$stats = Format(__("{0} and {1} total"), Plural($statData["numThreads"], __("thread")), Plural($statData["numPosts"], __("post")));
	$stats .= "<br />".format(__("{0} today, {1} last hour"), Plural($statData["newToday"], __("new post")), $statData["newLastHour"]);

	$percent = $statData["numUsers"] ? ceil((100 / $statData["numUsers"]) * $statData["numActive"]) : 0;
	$lastUser = Query("select u.(_userfields) from {users} u order by u.regdate desc limit 1");
	if(numRows($lastUser))
	{
		$lastUser = getDataPrefix(Fetch($lastUser), "u_");
		$last = format(__("{0}, {1} active ({2}%)"), Plural($statData["numUsers"], __("registered user")), $statData["numActive"], $percent)."<br />".format(__("Newest: {0}"), UserLink($lastUser));
	}
	else
		$last = __("No registered users")."<br />&nbsp;";


	write(
	"
		<table class=\"outline margin width100\" style=\"overflow: auto;\">
			<tr class=\"cell2 center\" style=\"overflow: auto;\">
			<td>
				<div style=\"float: left; width: 25%;\">&nbsp;<br />&nbsp;</div>
				<div style=\"float: right; width: 25%;\">{1}</div>
				<div class=\"center\">
					{0}
				</div>
			</td>
			</tr>
		</table>
	",	$stats, $last);
}

function makeAnncBar() {
    global $loguserid;
	
	$anncforum = Settings::get('announcementsForum');
	if ($anncforum > 0) {
		$annc = Query("	SELECT 
							t.id, t.title, t.icon, t.poll, t.forum,
							t.date anncdate,
							".($loguserid ? "tr.date readdate," : '')."
							u.(_userfields)
						FROM 
							{threads} t 
							".($loguserid ? "LEFT JOIN {threadsread} tr ON tr.thread=t.id AND tr.id={1}" : '')."
							LEFT JOIN {users} u ON u.id=t.user
						WHERE forum={0}
						ORDER BY anncdate DESC LIMIT 1", $anncforum, $loguserid);
								
		if ($annc && NumRows($annc))
		{
			$annc = Fetch($annc);
			$adata = array();
			
			$adata['new'] = '';
			if ((!$loguserid && $annc['anncdate'] > (time()-900)) ||
				($loguserid && $annc['anncdate'] > $annc['readdate']))
				$adata['new'] = "<div class=\"statusIcon new\"></div>";
			
			$adata['poll'] = ($annc['poll'] ? "<img src=\"".resourceLink('img/poll.png')."\" alt=\"Poll\"/> " : '');
			$adata['link'] = MakeThreadLink($annc);
			
			$user = getDataPrefix($annc, 'u_');
			$adata['user'] = UserLink($user);
			$adata['date'] = formatdate($annc['anncdate']);
		}
    ?>
    <table class="outline margin anncbar">
    	<tr class="header1">
			<th colspan="2">
				Announcement
			</th>
		</tr>
		<tr class="cell1">
			<td class="cell2 threadIcon newMarker">
				<?php echo $adata['new']; ?>
			</td>
			<td>
				<?php echo $adata['poll'], $adata['link'], "--- Posted by ", $adata['user'], " on ", $adata['date']; ?>
			</td>
		</tr>
</table> <?php
	}
}

printRefreshCode();
makeAnncBar();
makeForumListing(0);

?>
