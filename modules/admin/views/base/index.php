<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>

<div class="row">
    <div class="col-xs-6 col-md-3">
        <a href="/gii/" class="thumbnail">
            Gii
        </a>
    </div>
    <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
            <img src="..." alt="...">
        </a>
    </div>
</div>

</div>
