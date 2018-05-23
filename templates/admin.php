<?php
/** @var $l \OCP\IL10N */
/** @var $_ array */
script('n2ntransfer', 'settings-admin');
?>

<div id="n2ntransfer" class="section">
	<h2><?php p($l->t('n2ntransfer')); ?></h2>
	<h3><?php p($l->t('n2ntransfer_default_folder')); ?></h3>
	<p>
		<input id="n2ntransfer_default_folder" name="n2ntransfer_default_folder" type="text" class="" value="<?php echo $_['n2ntransfer_default_folder'];?>" />
		<label for="n2ntransfer_default_folder"><?php p($l->t('n2ntransfer_default_folder'));?></label>
	</p>
	<h3><?php p($l->t('n2ntransfer_password_composition')); ?></h3>
	<p class="settings-hint"><?php p($l->t('n2ntransfer_password_composition_hint')); ?></p>
	<p>
		<select id="n2ntransfer_password_cnt_alpha">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['n2ntransfer_password_cnt_alpha']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="n2ntransfer_password_cnt_alpha"><?php p($l->t('n2ntransfer_password_cnt_alpha')); ?></label>
	</p>
	<!--
	<p>
		<input id="n2ntransfer_password_upper_alpha" name="n2ntransfer_password_upper_alpha" type="checkbox" class="checkbox" value="1" <?php if ($_['n2ntransfer_password_upper_alpha']): ?> checked="checked"<?php endif; ?> />
		<label for="n2ntransfer_password_upper_alpha"><?php p($l->t('n2ntransfer_password_upper_alpha')); ?></label>
	</p>
	-->
	<p>
		<select id="n2ntransfer_password_cnt_numbers">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['n2ntransfer_password_cnt_numbers']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="n2ntransfer_password_cnt_numbers"><?php p($l->t('n2ntransfer_password_cnt_numbers')); ?></label>
	</p>
	<p>
		<select id="n2ntransfer_password_cnt_specialchars">
	<?php
		for($i=0; $i<11;$i++) {
	?>
			<option value="<?php echo $i;?>" <?php echo ($i==$_['n2ntransfer_password_cnt_specialchars']) ? 'selected="selected"' : '';?>><?php echo $i;?></option>
	<?php
		}
	?>
		</select>
		<label for="n2ntransfer_password_cnt_specialchars" title="!$%&=?*-:;.,+~@_"><?php p($l->t('n2ntransfer_password_cnt_specialchars')); ?></label>
	</p>

	<h3><?php p($l->t('n2ntransfer_externalcloud')); ?></h3>
	<p>
		<input id="n2ntransfer_externalcloud_host" name="n2ntransfer_externalcloud_host" type="text" class="" value="<?php echo $_['n2ntransfer_externalcloud_host'];?>" />
		<label for="n2ntransfer_externalcloud_host"><?php p($l->t('n2ntransfer_externalcloud_host')); ?></label>
	</p>
	<p>
		<input id="n2ntransfer_externalcloud_user" name="n2ntransfer_externalcloud_user" type="text" class="" value="<?php echo $_['n2ntransfer_externalcloud_user'];?>" />
		<label for="n2ntransfer_externalcloud_user"><?php p($l->t('n2ntransfer_externalcloud_user')); ?></label>
	</p>
	<p>
		<input type="password" name="n2ntransfer_externalcloud_pass" id="n2ntransfer_externalcloud_pass" placeholder="<?php p($l->t("Repeat new recovery key password")); ?>"/>
		<label for="n2ntransfer_externalcloud_pass"><?php p($l->t('n2ntransfer_externalcloud_pass')); ?></label>
	</p>
	<p>
		<input id="n2ntransfer_externalcloud_expiry" name="n2ntransfer_externalcloud_expiry" type="text" class="" value="<?php echo $_['n2ntransfer_externalcloud_expiry'];?>" />
		<label for="n2ntransfer_externalcloud_expiry"><?php p($l->t('n2ntransfer_externalcloud_expiry')); ?></label>
	</p>
	<h3><?php p($l->t('Mail')); ?></h3>
	<p>
		<input id="n2ntransfer_mails_subject" name="n2ntransfer_mails_subject" type="text" class="" value="<?php echo $_['n2ntransfer_mails_subject'];?>" />
		<label for="n2ntransfer_mails_subject"><?php p($l->t('n2ntransfer_mails_subject')); ?></label>
	</p>
	<p>
		<input id="n2ntransfer_mails_from_name" name="n2ntransfer_mails_from_name" type="text" class="" value="<?php echo $_['n2ntransfer_mails_from_name'];?>" />
		<label for="n2ntransfer_mails_from_name"><?php p($l->t('n2ntransfer_mails_from_name')); ?></label>
	</p>
	<p>
		<input id="n2ntransfer_mails_from" name="n2ntransfer_mails_from" type="text" class="" value="<?php echo $_['n2ntransfer_mails_from'];?>" />
		<label for="n2ntransfer_mails_from"><?php p($l->t('n2ntransfer_mails_from')); ?></label>
	</p>

</div>
