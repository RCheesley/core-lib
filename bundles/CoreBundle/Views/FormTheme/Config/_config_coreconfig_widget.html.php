<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

$fields = $form->children;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $view['translator']->trans('mautic.core.config.header.general'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'site_url'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'update_stability'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'cache_path'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'log_path'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'theme'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'image_path'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $view['translator']->trans('mautic.core.config.header.defaults'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'default_pagelimit'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'default_timezone'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'locale'); ?>
            </div>
        </div>

        <hr class="text-muted" />

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'date_format_full'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'date_format_short'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'date_format_dateonly'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'date_format_timeonly'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $view['translator']->trans('mautic.core.config.header.mail'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_from_name'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_from_email'); ?>
            </div>
        </div>

        <hr class="text-muted" />

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_transport'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_host'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_port'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_encryption'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_auth_mode'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_user'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_password'); ?>
            </div>
        </div>

        <hr class="text-muted" />

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_type'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_path'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_msg_limit'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_time_limit'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_recover_timeout'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'mailer_spool_clear_timeout'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $view['translator']->trans('mautic.core.config.header.cookie'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'cookie_path'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'cookie_domain'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'cookie_secure'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'cookie_httponly'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'rememberme_key'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'rememberme_lifetime'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'rememberme_path'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'rememberme_domain'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $view['translator']->trans('mautic.core.config.header.misc'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'trusted_hosts'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'trusted_proxies'); ?>
            </div>
        </div>

        <hr class="text-muted" />

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'ip_lookup_service'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'ip_lookup_auth'); ?>
            </div>
        </div>

        <?php if (isset($fields['transifex_username'])): ?>
        <hr class="text-muted" />

        <div class="row">
            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'transifex_username'); ?>
            </div>

            <div class="col-md-6">
                <?php echo $view['form']->rowIfExists($fields, 'transifex_password'); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>