<td>
    <ul class="a-ui a-admin-td-actions">
        <?php echo $helper->linkToEdit($a_poll_poll, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($a_poll_poll, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToListAnswers($a_poll_poll, array('params' => array())) ?>

        <li class="a-admin-action-export-answers">
            <?php echo a_button(
                    '<span class="icon"></span>' . __('Reports', array(), 'apostrophe'),
                    '#',
                    array('class' => 'icon no-label a-poll-export-answers'),
                    'a-poll-export-answers-'.$a_poll_poll->getId()
                    ) ?>
            <div class="a-ui a-options a-poll-admin-export-answers-ajax dropshadow">
                <?php include_component('aPollPollAdmin', 'exportAnswers', array('poll_id' => $a_poll_poll->getId())) ?>
            </div>
        </li>
    </ul>
</td>
