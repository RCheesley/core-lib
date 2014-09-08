<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
$view->extend('MauticCoreBundle:Default:content.html.php');
$view['slots']->set('mauticContent', 'leadfield');
$view['slots']->set("headerTitle", $view['translator']->trans('mautic.lead.field.header.index'));
?>
<?php $view['slots']->start("actions"); ?>
    <a href="<?php echo $this->container->get('router')->generate(
        'mautic_leadfield_action', array("objectAction" => "new")); ?>"
        data-toggle="ajax"
        class="btn btn-default"
        data-menu-link="#mautic_lead_index">
        <i class="fa fa-plus"></i> <?php echo $view["translator"]->trans("mautic.lead.field.menu.new"); ?>
    </a>
<?php $view['slots']->stop(); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo $view['translator']->trans('mautic.lead.field.header.index'); ?>
        </h3>
    </div>
    <div class="panel-toolbar-wrapper">
        <div class="panel-toolbar">
            <div class="checkbox custom-checkbox pull-left">
                <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#reportTable">
                <label for="customcheckbox-one0"><?php echo $view['translator']->trans('mautic.core.table.selectall'); ?></label>
            </div>
        </div>
        <div class="panel-toolbar text-right">
            <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-files-o"></i></button>
            <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
    <div class="table-responsive scrollable body-white padding-sm">
        <table class="table table-hover table-striped table-bordered leadfield-list">
            <thead>
                <th class="col-leadfield-orderhandle"></th>
                <th class="col-leadfield-actions"></th>
                <th class="col-leadfield-label"><?php echo $view['translator']->trans('mautic.lead.field.thead.label'); ?></th>
                <th class="visible-md visible-lg col-leadfield-alias"><?php echo $view['translator']->trans('mautic.lead.field.thead.alias'); ?></th>
                <th class="visible-md visible-lg col-leadfield-group"><?php echo $view['translator']->trans('mautic.lead.field.thead.group'); ?></th>
                <th class="col-leadfield-type"><?php echo $view['translator']->trans('mautic.lead.field.thead.type'); ?></th>
                <th class="visible-md visible-lg col-leadfield-id"><?php echo $view['translator']->trans('mautic.lead.field.thead.id'); ?></th>
                <th class="visible-md visible-lg col-leadfield-statusicons"></th>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr id="field_<?php echo $item->getId(); ?>">
                    <td><i class="fa fa-fw fa-ellipsis-v"></i></td>
                    <td>
                        <?php
                        echo $view->render('MauticCoreBundle:Helper:actions.html.php', array(
                            'item'      => $item,
                            'edit'      => true,
                            'clone'     => true,
                            'delete'    => $item->isFixed() ? false : true,
                            'routeBase' => 'leadfield',
                            'menuLink'  => 'mautic_leadfield_index',
                            'langVar'   => 'lead.field',
                            'pull'      => 'left'
                        ));
                        ?>
                    </td>
                    <td>
                        <?php echo $view->render('MauticCoreBundle:Helper:publishstatus.html.php',array(
                            'item'       => $item,
                            'model'      => 'lead.field'
                        )); ?>
                        <?php echo $item->getLabel(); ?>
                    </td>
                    <td class="visible-md visible-lg"><?php echo $item->getAlias(); ?></td>
                    <td class="visible-md visible-lg"><?php echo $view['translator']->trans('mautic.lead.field.group.'.$item->getGroup()); ?></td>
                    <td><?php echo $view['translator']->trans('mautic.lead.field.type.'.$item->getType()); ?></td>
                    <td class="visible-md visible-lg"><?php echo $item->getId(); ?></td>
                    <td>
                        <?php if ($item->isRequired()): ?>
                            <i class="fa fa-asterisk" data-toggle="tooltip" data-placement="left"
                               title="<?php echo $view['translator']->trans('mautic.lead.field.tooltip.required'); ?>"></i>
                        <?php endif; ?>
                        <?php if (!$item->isVisible()): ?>
                            <i class="fa fa-eye-slash" data-toggle="tooltip" data-placement="left"
                               title="<?php echo $view['translator']->trans('mautic.lead.field.tooltip.invisible'); ?>"></i>
                        <?php endif; ?>
                        <?php if ($item->isFixed()): ?>
                            <i class="fa fa-lock" data-toggle="tooltip" data-placement="left"
                               title="<?php echo $view['translator']->trans('mautic.lead.field.tooltip.fixed'); ?>"></i>
                        <?php endif; ?>
                        <?php if ($item->isListable()): ?>
                            <i class="fa fa-list "data-toggle="tooltip" data-placement="left"
                               title="<?php echo $view['translator']->trans('mautic.lead.field.tooltip.listable'); ?>"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>