<?php

function psbox_config()
{
?>
<div class="wrap" style="padding: 10px;">
<form method="post" action="options.php">
<?php

// New way of setting the fields, for WP 2.7 and newer
if(function_exists('settings_fields'))
{
	settings_fields('ps-options');
}
else
{

wp_nonce_field('update-options');

?>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="ps_url_shortner,ps_bitly_user,ps_bitly_api" />

<?php

}

?>

<script type="text/javascript">
function switch_shortener(formu_predef)
{
	formu = formu_predef.elements['ps_url_shortner'].options[formu_predef.elements['ps_url_shortner'].selectedIndex].value;

	if(formu == 'bitly')
	{
		document.getElementById('blocx_ps_bitly_user').style.display = '';
		document.getElementById('blocx_ps_bitly_api').style.display = '';
	}
	else
	{
		document.getElementById('blocx_ps_bitly_user').style.display = 'none';
		document.getElementById('blocx_ps_bitly_api').style.display = 'none';
	}
}
</script>

<br />

<table class="form-table">
<tr>
<th scope="row" valign="top"><?php echo __("URL Shortener", "popup-shortlink"); ?></th>
<td>
<select name="ps_url_shortner" onchange="switch_shortener(this.form);">
<option <?php if(get_option('ps_url_shortner') == '0abfr') echo 'selected="selected"'; ?> value="qrcx">qr.cx/xxx</option>
<option <?php if(get_option('ps_url_shortner') == 'bitly') echo 'selected="selected"'; ?> value="bitly">bit.ly/xxx</option>
<option <?php if(get_option('ps_url_shortner') == 'tinyurl') echo 'selected="selected"'; ?> value="tinyurl">tinyurl.com/xxx</option>
<option <?php if(get_option('ps_url_shortner') == 'tinyurl') echo 'selected="selected"'; ?> value="tk">xxx.tk</option>
</select>
</td>
</tr>
<tr>
<td colspan="2"><span class="description"><?php echo __("If you use <strong>Bit.ly</strong>, an API key is necessary", "popup-shortlink"); ?> (<a href="http://bit.ly/" target="_blank">Bit.ly</a>).</span></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr id="blocx_ps_bitly_user" style="<?php if(get_option('ps_url_shortner') !== 'bitly') echo 'display: none;'; ?>">
<th scope="row" valign="top">
<label for="ps_bitly_user"><?php echo __("Username <strong>Bit.ly</strong>", "popup-shortlink"); ?></label>
</th>
<td>
<input type="text" value="<?php echo get_option('ps_bitly_user'); ?>" name="ps_bitly_user" id="ps_bitly_user" />
</td>
</tr>
<tr id="blocx_ps_bitly_api" style="<?php if(get_option('ps_url_shortner') !== 'bitly') echo 'display: none;'; ?>">
<th scope="row" valign="top">
<label for="ps_bitly_api"><?php echo __("API key <strong>Bit.ly</strong>", "popup-shortlink"); ?></label>
</th>
<td>
<input type="text" value="<?php echo get_option('ps_bitly_api'); ?>" name="ps_bitly_api" id="ps_bitly_api" />
</td>
</tr>
</table>

<br />

<p class="submit"><input type="submit" name="Submit" value="<?php echo __("Save Changes", "popup-shortlink") ?>" /></p>

</form>

<a href="http://pirmax.fr/2011/06/03/traductions-pour-le-plugin-popup-shortlink/" target="_blank"><?php echo __("Click here", "popup-shortlink"); ?></a> <?php echo __("to download more translations", "popup-shortlink") ?>.<br /><br /><br />

<p><b><?php echo __("Rating this plugin:", "popup-shortlink"); ?></b> <a href="http://wordpress.org/support/view/plugin-reviews/popup-shortlink?rate=1#postform" target="_blank">1 étoile</a> <a href="http://wordpress.org/support/view/plugin-reviews/popup-shortlink?rate=2#postform" target="_blank">2 étoiles</a> <a href="http://wordpress.org/support/view/plugin-reviews/popup-shortlink?rate=3#postform" target="_blank">3 étoiles</a> <a href="http://wordpress.org/support/view/plugin-reviews/popup-shortlink?rate=4#postform" target="_blank">4 étoiles</a> <a href="http://wordpress.org/support/view/plugin-reviews/popup-shortlink?rate=5#postform" target="_blank">5 étoiles</a></p>

</div>
<?php
}

add_meta_box("popup-shortlink", __("Parameters for the integration of PopUP Shortlink", "popup-shortlink"), "psbox_config", "psbox");

echo '<div class="metabox-holder">';

echo '<div style="width: 100%; margin-top: 20px;" class="inner-sidebar1">';
do_meta_boxes("psbox", "advanced", null);
echo '</div>';

echo '<div style="clear:both"></div>';

echo '</div>';

?>