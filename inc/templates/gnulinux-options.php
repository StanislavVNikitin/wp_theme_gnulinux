<div class="wrap gnulinux-options">
	<h1><?php echo __('Theme Options Page','gnulinux') ?></h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('gnulinux_general_group');?>
        <?php do_settings_sections('gnulinux-options');?>
        <?php submit_button();?>

    </form>
</div>
