<div class="wrap">
    <form method="post" action="options.php">
        <?php
        // This prints out all hidden setting fields
        settings_fields('wpns');
        do_settings_sections('wpns-settings');
        submit_button();
        ?>
    </form>
</div>