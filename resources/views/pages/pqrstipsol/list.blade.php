<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
//check if current user role is allowed access to the pages
$can_add = $user->canAccess('pqrstipsol/add');
$can_edit = $user->canAccess('pqrstipsol/edit');
$can_view = $user->canAccess('pqrstipsol/view');
$can_delete = $user->canAccess('pqrstipsol/delete');
$field_name = request()->segment(3);
$field_value = request()->segment(4);
$total_records = $records->total();
$limit = $records->perPage();
$record_count = count($records);
$pageTitle = 'Pqrs Tipsol'; //set dynamic page title
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
                            <div class="h5 font-weight-bold text-primary">Pqrs Tipsol</div>
                        </div>
                    </div>
                    <div class="col-auto  ">
                        <?php if($can_add){ ?>
                        <a class="btn btn-primary btn-block" href="<?php print_link('pqrstipsol/add', true); ?>">
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
                            <div id="pqrstipsol-list-records">
                                <div id="page-main-content" class="table-responsive">
                                    <div class="ajax-page-load-indicator" style="display:none">
                                        <div class="text-center d-flex justify-content-center load-indicator">
                                            <span class="loader mr-3"></span>
                                            <span class="fw-bold">Cargando...</span>
                                        </div>
                                    </div>
                                    <?php Html::page_bread_crumb('/pqrstipsol/', $field_name, $field_value); ?>
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
                                                <th class="td-id_tipsol"> Id Tipsol</th>
                                                <th class="td-tipsol_nombre"> Tipsol Nombre</th>
                                                <th class="td-date_created"> Date Created</th>
                                                <th class="td-date_updated"> Date Updated</th>
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
                                        $rec_id = ($data['id_tipsol'] ? urlencode($data['id_tipsol']) : null);
                                        $counter++;
                                    ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                        <input class="optioncheck form-check-input" name="optioncheck[]"
                                                            value="<?php echo $data['id_tipsol']; ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-id_tipsol">
                                                    <a href="<?php print_link("/pqrstipsol/view/$data[id_tipsol]"); ?>"><?php echo $data['id_tipsol']; ?></a>
                                                </td>
                                                <td class="td-tipsol_nombre">
                                                    <?php echo $data['tipsol_nombre']; ?>
                                                </td>
                                                <td class="td-date_created">
                                                    <?php echo $data['date_created']; ?>
                                                </td>
                                                <td class="td-date_updated">
                                                    <?php echo $data['date_updated']; ?>
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
                                                            <a class="dropdown-item " href="<?php print_link("pqrstipsol/view/$rec_id"); ?>">
                                                                <i class="material-icons">visibility</i> View
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="dropdown-item " href="<?php print_link("pqrstipsol/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a class="dropdown-item record-delete-btn"
                                                                data-prompt-msg="¿Seguro que quieres borrar este registro?"
                                                                data-display-style="modal" href="<?php print_link("pqrstipsol/delete/$rec_id"); ?>">
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
                                                data-display-style="modal" data-url="<?php print_link('pqrstipsol/delete/{sel_ids}'); ?>"
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
