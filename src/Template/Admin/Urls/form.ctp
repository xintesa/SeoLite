<?php
$this->assign('title', __d('croogo', 'URLs'));
$this->extend('/Common/admin_edit');

$this->Html->addCrumb(__d('croogo', 'URLs'), ['action' => 'index']);

if ($this->request->param('action') === 'edit') {
    $this->Html->addCrumb($url->url);
    $this->assign('title', 'Url: ' . $url->url);
} else {
    $this->Html->addCrumb(__d('croogo', 'Add'));
}

$this->append('form-start', $this->Form->create($url, [
    'class' => 'protected-form',
]));

$this->append('tab-heading');
echo $this->Croogo->adminTab(__d('croogo', 'Url'), '#seo-lite-url');
$this->end();

$this->append('tab-content');
echo $this->Html->tabStart('seo-lite-url');
echo $this->Form->input('url', [
    'label' => 'Url',
]);
echo $this->Form->input('description', [
    'label' => 'Description',
]);
echo $this->Form->input('status', [
    'label' => 'Status',
    'class' => false,
]);
echo $this->Html->tabEnd();

$this->end();

$this->append('form-end', $this->Form->end());
