<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<h1>Products</h1>
		  </div>
		  <div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard') ?>">Dashboard</a></li>
			  <li class="breadcrumb-item active">Products</li>
			</ol>
		  </div>
		</div>
	  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- /.row -->
		<div class="row">
		  	<div class="col-12">
				<div class="card">
			  		<div class="card-header">
					<h3 class="card-title">List of Products</h3>
					<div class="card-tools">
						<div class="input-group input-group-sm" style="width: 150px;">
							<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
							<div class="input-group-append">
								<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
			  </div>
			  <!-- /.card-header -->
			  	<div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th>SKU</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Status</th>
							<th style="width:15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($products): ?>
							<?php foreach ($products as $product): ?>
								<tr>
									<td><?= $product->sku ?></td>
									<td></td>
									<td><?= $product->name ?></td>
									<td><?= $product->price ?></td>
									<td><?= $product->qty ?></td>
									<td><?= $statuses[$product->status] ?></td>
									<td>
										<a href="<?= site_url('admin/products/'. $product->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
										<form method="POST" action="<?= site_url('admin/brands/'. $product->id) ?>" accept-charset="UTF-8" class="delete" style="display:inline-block">
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5">No record found</td>
							</tr>
						<?php endif; ?>
					</tbody>
					</table>
			  	</div>
				<!-- /.card-body -->
				<div class="card-footer clearfix">
					<div class="row">
						<div class="col-8">
							<?php echo $pager->links('bootstrap', 'bootstrap_pagination') ?>
						</div>
						<div class="col-4 text-right">
							<a href="<?= site_url('admin/products/create') ?>" class="btn btn-success">New Product</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /.card -->
		  	</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>