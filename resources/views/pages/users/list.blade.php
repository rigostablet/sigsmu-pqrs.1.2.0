<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
//check if current user role is allowed access to the pages
$can_add = $user->canAccess('users/add');
$can_edit = $user->canAccess('users/edit');
$can_view = $user->canAccess('users/view');
$can_delete = $user->canAccess('users/delete');
$field_name = request()->segment(3);
$field_value = request()->segment(4);
$total_records = $records->total();
$limit = $records->perPage();
$record_count = count($records);
$pageTitle = 'Users'; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
    <section class="page ajax-page" data-page-type="list" data-page-url="{{ url()->full() }}">
        <?php
        if( $show_header == true ){
    ?>
        <div class="bg-light p-3 mb-3">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gap-3">
                    <div class="col  ">
                        <div class="">
                            <div class="h5 font-weight-bold text-primary">Users</div>
                        </div>
                    </div>
                    <div class="col-auto  ">
                        <?php if($can_add){ ?>
                        <a class="btn btn-primary btn-block" href="<?php print_link('users/add', true); ?>">
                            <i class="material-icons">add</i>
                            Agregar nuevo
                        </a>
                        <?php } ?>
                    </div>
                    <div class="col-md-3  ">
                        <!-- Page drop down search component -->
                        <form class="search" action="{{ url()->current() }}" method="get">
                            <input type="hidden" name="page" value="1" />
                            <div class="input-group">
                                <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text"
                                    name="search" placeholder="Buscar" />
                                <button class="btn btn-primary"><i class="material-icons">search</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>
        <div class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col comp-grid ">
                        <div class=" page-content">
                            <div id="users-list-records">
                                <div id="page-main-content" class="table-responsive">
                                    <div class="ajax-page-load-indicator" style="display:none">
                                        <div class="text-center d-flex justify-content-center load-indicator">
                                            <span class="loader mr-3"></span>
                                            <span class="fw-bold">Cargando...</span>
                                        </div>
                                    </div>
                                    <?php Html::page_bread_crumb('/users/', $field_name, $field_value); ?>
                                    <?php Html::display_page_errors($errors); ?>
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="form-check-label">
                                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-id"> Id</th>
                                                <th class="td-name"> Name</th>
                                                <th class="td-email"> Email</th>
                                                <th class="td-email_verified_at"> Email Verified At</th>
                                                <th class="td-remember_token"> Remember Token</th>
                                                <th class="td-created_at"> Created At</th>
                                                <th class="td-updated_at"> Updated At</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                    if($total_records){
                                ?>
                                        <tbody class="page-data">
                                            <!--record-->
                                            <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                        <input class="optioncheck form-check-input" name="optioncheck[]"
                                                            value="<?php echo $data['id']; ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-id">
                                                    <a href="<?php print_link("/users/view/$data[id]"); ?>"><?php echo $data['id']; ?></a>
                                                </td>
                                                <td class="td-name">
                                                    <?php echo $data['name']; ?>
                                                </td>
                                                <td class="td-email">
                                                    <a href="<?php print_link("mailto:$data[email]"); ?>"><?php echo $data['email']; ?></a>
                                                </td>
                                                <td class="td-email_verified_at">
                                                    <a href="<?php print_link("mailto:$data[email_verified_at]"); ?>"><?php echo $data['email_verified_at']; ?></a>
                                                </td>
                                                <td class="td-remember_token">
                                                    <?php echo $data['remember_token']; ?>
                                                </td>
                                                <td class="td-created_at">
                                                    <?php echo $data['created_at']; ?>
                                                </td>
                                                <td class="td-updated_at">
                                                    <?php echo $data['updated_at']; ?>
                                                </td>
                                                <!--PageComponentEnd-->
                                                <td class="td-btn">
                                                    <div class="dropdown">
                                                        <button data-bs-toggle="dropdown"
                                                            class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                            <i class="material-icons">menu</i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($can_view){ ?>
                                                            <a class="dropdown-item " href="<?php print_link("users/view/$rec_id"); ?>">
                                                                <i class="material-icons">visibility</i> View
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="dropdown-item " href="<?php print_link("users/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a class="dropdown-item record-delete-btn"
                                                                data-prompt-msg="¿Seguro que quieres borrar este registro?"
                                                                data-display-style="modal" href="<?php print_link("users/delete/$rec_id"); ?>">
                                                                <i class="material-icons">delete_sweep</i> Delete
                                                            </a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                            }
                        ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data"></tbody>
                                        <?php
                        }
                        else{
                    ?>
                                        <tbody class="page-data">
                                            <tr>
                                                <td class="bg-light text-center text-muted animated bounce p-3"
                                                    colspan="1000">
                                                    <i class="material-icons">block</i> ningún registro fue encontrado
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php
                        }
                    ?>
                                    </table>
                                </div>
                                <?php
                if($show_footer){
            ?>
                                <div class=" mt-3">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-md-auto d-flex">
                                            <?php if($can_delete){ ?>
                                            <button
                                                data-prompt-msg="¿Está seguro de que desea eliminar estos registros?
                        "
                                                data-display-style="modal" data-url="<?php print_link('users/delete/{sel_ids}'); ?>"
                                                class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                <i class="material-icons">delete_sweep</i> Eliminar seleccionado
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <div class="col">
                                            <?php
                                            if ($show_pagination == true) {
                                                $pager = new Pagination($total_records, $record_count);
                                                $pager->show_page_count = false;
                                                $pager->show_record_count = true;
                                                $pager->show_page_limit = false;
                                                $pager->limit = $limit;
                                                $pager->show_page_number_list = true;
                                                $pager->pager_link_range = 5;
                                                $pager->ajax_page = true;
                                                $pager->render();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                }
            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!-- Page custom css -->
@section('pagecss')
    <style>

    </style>
@endsection
<!-- Page custom js -->
@section('pagejs')
    <script>
        <!--pageautofill
        -->
        $(document).ready(function() {
        //
        custom
        javascript
        |
        jquery
        codes
        });

    </script>
@endsection
