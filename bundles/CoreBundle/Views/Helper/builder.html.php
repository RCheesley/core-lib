<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
?>
<div class="hide builder <?php echo 'type'; ?>-builder">
    <script type="text/html" data-builder-assets>
        <?php echo htmlspecialchars($builderAssets); ?>
    </script>
    <div class="builder-content">
        <input type="hidden" id="builder_url" value="<?php echo $view['router']->path('mautic_'.$type.'_action', array('objectAction' => 'builder', 'objectId' => $objectId)); ?>" />
    </div>
    <div class="builder-panel">
        <div class="builder-panel-top">
            <button type="button" class="btn btn-primary btn-close-builder" onclick="Mautic.closeBuilder('<?php echo 'type'; ?>');">
                <?php echo $view['translator']->trans('mautic.core.close.builder'); ?>
            </button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Slot Types</h4>
            </div>
            <div class="panel-body" id="slot-type-container">
                <?php if ($slots): ?>
                    <?php foreach ($slots as $slotKey => $slot): ?>
                        <div class="slot-type-handle btn btn-default btn-lg btn-block" data-slot-type="<?php echo $slotKey; ?>">
                            <i class="fa fa-<?php echo $slot['icon']; ?>" aria-hidden="true"></i>
                            <?php echo $slot['header']; ?>
                            <script type="text/html">
                                <?php echo $view->render($slot['content']); ?>
                            </script>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <p class="text-muted pt-md text-center"><i>Drag the slot type to the desired position.</i></p>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Customize Slot</h4>
            </div>
            <div class="panel-body" id="customize-form-container">
                <div id="slot-form-container">
                    <p class="text-muted pt-md text-center"><i>Select the slot to customize</i></p>
                </div>
                <?php if ($slots): ?>
                    <?php foreach ($slots as $slotKey => $slot): ?>
                        <script type="text/html" data-slot-type-form="<?php echo $slotKey; ?>">
                            <?php echo $view['form']->start($slot['form']); ?>
                            <?php echo $view['form']->end($slot['form']); ?>
                        </script>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
