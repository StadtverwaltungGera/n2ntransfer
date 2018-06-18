<?php
$files = $_['files'];
?>
<script>

</script>
<h2><?php echo $l->t('n2ntransfer_visible_subfolders'); ?> (<?php echo $_['userdata']['homeRel'];?>)</h2>

<form id="n2ntransfer" class="section" method="POST">
<?php
if(count($files)>0) {
	$prev_level = -1;
	for($i=0; $i<count($files); $i++) {
		$curr_level = substr_count(substr($files[$i],0,-1),"/");
		$dir = (substr($files[$i],-1)=="/");
		$name=$i;
		if($prev_level<$curr_level) {
			echo "<ul>";
		} else if ($prev_level>$curr_level) {
			echo str_repeat("</ul></li>", $prev_level-$curr_level);
		}
		// echo$_['userdata']['home']."/".$files[$i];
		if(is_dir($_['userdata']['home']."/".$files[$i])) {
			$class="icon-folder";
		} else {
			$class="icon-file";
		}
		echo "<li><span class=\"".$class."\" style=\"display:inline-block;width:20px;\"></span>";
		echo "<input class=\"checkbox\" type=\"checkbox\" name=\"checked_files[".$name."]\" id=\"files_".$name."\" aria-data-level=\"".$curr_level."\" aria-data-current=\"".$i."\"/>";
		echo "<label for=\"files_".$name."\">".$files[$i]."</label>";
		if(!$dir) {
			echo " (".round(filesize($_['userdata']['home']."/".$files[$i])/1024, 1)." kB)";
			// echo $files[$i];
			echo "</li>";
		} else {
			echo "<ul>";
			$curr_level++;
		}
		$prev_level = $curr_level;
	}
	echo str_repeat("</ul></li>", $prev_level);
?>
	</ul>
<button type="button" id="checkAll" aria-data-checked="0"><?php echo $l->t('n2ntransfer_markall'); ?></button>
<button type="submit"><?php echo $l->t('n2ntransfer_submit'); ?></button>
<?php
} else {
		echo $l->t('n2ntransfer_no_files_found');
}
?>
</form>
