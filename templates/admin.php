<?php
/** @var $l \OCP\IL10N */
/** @var $_ array */
#script('generictrigger', 'admin');         // adds a JavaScript file
script('generictrigger', 'settings-admin');
#style('generictrigger', 'admin');    // adds a CSS file
// echo "<pre>";
// print_r($_);
// echo "</pre>";
// die();
?>

<div id="generictrigger" class="section">
	<h2><?php p($l->t('generictrigger')); ?></h2>
	<h3><?php p($l->t('Default folder')); ?></h3>
	<p>
		<input id="generictrigger_default_folder" name="generictrigger_default_folder" type="text" class="" value="<?php echo $_['generictrigger_default_folder'];?>" />
		<label for="generictrigger_default_folder">generictrigger_default_folder</label>
	</p>
	<h3><?php p($l->t('Password composition')); ?></h3>
	<p class="settings-hint"><?php p($l->t('Adjust how people can share between servers.')); ?></p>
	<p>
		<select id="generictrigger_password_cnt_alpha">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['generictrigger_password_cnt_alpha']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="generictrigger_password_cnt_alpha">generictrigger_password_cnt_alpha</label>
	</p>
	<!--
	<p>
		<input id="generictrigger_password_upper_alpha" name="generictrigger_password_upper_alpha" type="checkbox" class="checkbox" value="1" <?php if ($data['enabled']): ?> checked="checked"<?php endif; ?> />
		<label for="generictrigger_password_upper_alpha">generictrigger_password_upper_alpha</label>
	</p>
	-->
	<p>
		<select id="generictrigger_password_cnt_numbers">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['generictrigger_password_cnt_numbers']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="generictrigger_password_cnt_numbers">generictrigger_password_cnt_numbers</label>
	</p>
	<p>
		<select id="generictrigger_password_cnt_specialchars">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['generictrigger_password_cnt_specialchars']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="generictrigger_password_cnt_specialchars" title="!$%&=?*-:;.,+~@_">generictrigger_password_cnt_specialchars</label>
	</p>

	<h3><?php p($l->t('External nextcloud')); ?></h3>
	<p>
		<input id="generictrigger_externalcloud_host" name="generictrigger_externalcloud_host" type="text" class="" value="<?php echo $_['generictrigger_externalcloud_host'];?>" />
		<label for="generictrigger_externalcloud_host">generictrigger_externalcloud_host</label>
	</p>
	<p>
		<input id="generictrigger_externalcloud_user" name="generictrigger_externalcloud_user" type="text" class="" value="<?php echo $_['generictrigger_externalcloud_user'];?>" />
		<label for="generictrigger_externalcloud_user">generictrigger_externalcloud_user</label>
	</p>
	<p>
		<input type="password" name="generictrigger_externalcloud_pass" id="generictrigger_externalcloud_pass" placeholder="<?php p($l->t("Repeat new recovery key password")); ?>"/>
		<label for="generictrigger_externalcloud_pass">generictrigger_externalcloud_pass</label>
	</p>
	<p>
		<input id="generictrigger_externalcloud_expiry" name="generictrigger_externalcloud_expiry" type="text" class="" value="<?php echo $_['generictrigger_externalcloud_expiry'];?>" />
		<label for="generictrigger_externalcloud_expiry">generictrigger_externalcloud_expiry</label>
	</p>
	<h3><?php p($l->t('Mail')); ?></h3>
	<p>
		<input id="generictrigger_mails_subject" name="generictrigger_mails_subject" type="text" class="" value="<?php echo $_['generictrigger_mails_subject'];?>" />
		<label for="generictrigger_mails_subject">generictrigger_mails_subject</label>
	</p>
	<p>
		<input id="generictrigger_mails_from_name" name="generictrigger_mails_from_name" type="text" class="" value="<?php echo $_['generictrigger_mails_from_name'];?>" />
		<label for="generictrigger_mails_from_name">generictrigger_mails_from_name</label>
	</p>
	<p>
		<input id="generictrigger_mails_from" name="generictrigger_mails_from" type="text" class="" value="<?php echo $_['generictrigger_mails_from'];?>" />
		<label for="generictrigger_mails_from">generictrigger_mails_from</label>
	</p>

</div>
