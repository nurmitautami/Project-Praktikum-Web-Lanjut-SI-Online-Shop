<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= isset($attribute) ? 'Update' : 'New' ?> attribute</h3>
	</div>
	<!-- /.card-header -->
	<!-- form start -->
	<?php if (!empty($attribute)): ?>
		<form role="form" method="post" action="<?= site_url('admin/attributes/'. $attribute->id) ?>">
		<input name="_method" type="hidden" value="PUT">
	<?php else: ?>
		<?= form_open('admin/attributes') ?>
	<?php endif; ?>
		<?= form_hidden('id', isset($attribute->id) ? $attribute->id : '' ) ?>
		<div class="card-body">
			<?= view('admin/shared/flash_message') ?>
			<div class="form-group">
				<label for="attributeCode">Code</label>
				<?= form_input('code', set_value('code', isset($attribute->code) ? ($attribute->code) : '' ), ['class' => 'form-control', 'id' => 'attributeCode', 'placeholder' => 'Enter attribute code']) ?>
			</div>
			<div class="form-group">
				<label for="attributeName">Name</label>
				<?= form_input('name', set_value('name', isset($attribute->name) ? ($attribute->name) : '' ), ['class' => 'form-control', 'id' => 'attributeName', 'placeholder' => 'Enter attribute name']) ?>
			</div>
			<div class="form-group">
				<label for="attributeType">Type</label>
				<?= form_dropdown('type', $attributeTypes, set_value('type', isset($attribute->type) ? ($attribute->type) : '' ), ['class' => 'form-control', 'id' => 'attributeType']) ?>
			</div>
		</div>
		<!-- /.card-body -->

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
			
			<?php if (!empty($attribute)): ?>
				<a href="<?= site_url('admin/attributes') ?>" class="btn btn-default">Cancel</a>
			<?php endif;?>
		</div>
	</form>
</div>
<!-- /.card -->