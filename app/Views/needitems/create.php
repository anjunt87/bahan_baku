<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <div class="card-title">Create Need Items Bundle</div>
                            </div>

                            <?php if (session()->getFlashdata('errors')) : ?>
                                <div class="alert alert-danger">
                                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                        <p><?= $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>

                            <form action="<?= base_url('/needitems/store') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="bundle_name" class="form-label">Bundle Name</label>
                                    <input type="text" class="form-control" id="bundle_name" name="bundle_name" value="<?= old('bundle_name') ?>" required>
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="mb-3">
                                    <div class="card-body">
                                        <label for="items" class="form-label">Items</label>
                                        <div id="items">
                                            <div class="row g-3 mt-2 align-items-center item-group">
                                                <div class="col-auto">
                                                    <select class="form-control form-select" name="items[0][item_id]" required>
                                                        <option value="">Select Item</option>
                                                        <?php foreach ($items as $item) : ?>
                                                            <option value="<?= $item['id_items'] ?>"><?= $item['name_items'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <input type="number" class="form-control" name="items[0][quantity]" placeholder="Quantity" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary mt-3" id="add-item">Add Item</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Bundle</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Template SideBar -->
<?= $this->include('template/footer') ?>
</div>
</div>
</div>
</div>
<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const itemGroup = document.querySelector('.item-group').cloneNode(true);
        itemGroup.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace(/\d+/, itemIndex);
            input.value = '';
        });
        document.getElementById('items').appendChild(itemGroup);
        itemIndex++;
    });
</script>
<!-- Tambahkan script JS untuk interaktivitas (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>