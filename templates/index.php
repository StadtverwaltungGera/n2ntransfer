<?php
script('generictrigger', 'script');
style('generictrigger', 'style');
?>

<div id="app">
	<?php print_unescaped($this->inc('content/index')); ?>
<!--
	<div id="app-navigation">
		<?php #print_unescaped($this->inc('navigation/index')); echo "<p>navigation/index</p>"; ?>
		<?php #print_unescaped($this->inc('settings/index')); echo "<p>settings/index</p>"; ?>
	</div>
	<div id="app-content">
		<div id="app-content-wrapper" class="app-generictrigger" role="main">
		</div>
	</div>
-->
</div>

