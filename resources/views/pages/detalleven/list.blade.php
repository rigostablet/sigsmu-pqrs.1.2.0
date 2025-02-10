<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
//check if current user role is allowed access to the pages
$can_add = $user->canAccess('detalleven/add');
$can_edit = $user->canAccess('detalleven/edit');
$can_view = $user->canAccess('detalleven/view');
$can_delete = $user->canAccess('detalleven/delete');
$field_name = request()->segment(3);
$field_value = request()->segment(4);
$total_records = $records->total();
$limit = $records->perPage();
$record_count = count($records);
$pageTitle = ''; //set dynamic page title
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
                <div class="row ">
                    <div class="col  ">
                        <div class="">
                            <div class=" h5 font-weight-bold text-primary">Detalle pqrs por vencer o vencidas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
    ?>
        <div class="mb-5">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col comp-grid ">
                    </div>
                    <div class="col-12 comp-grid ">
                        <div class="color-success h4 text-right page-content">
                            <div id="detalleven-list-records">
                                <div id="page-main-content" class="table-responsive">
                                    <div class="ajax-page-load-indicator" style="display:none">
                                        <div class="text-center d-flex justify-content-center load-indicator">
                                            <span class="loader mr-3"></span>
                                            <span class="fw-bold">Cargando...</span>
                                        </div>
                                    </div>
                                    <?php Html::page_bread_crumb('/detalleven/', $field_name, $field_value); ?>
                                    <?php Html::display_page_errors($errors); ?>
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <table class="table table-hover btn-light text-warning table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <th class="td-rad_sol"> radicado</th>
                                                <th class="td-id_asig_sol"> responsable</th>
                                                <th class="td-nom_ofic_user"> oficina</th>
                                                <th class="td-regsol_est"> estado</th>
                                                <th class="td-fec_sol"> Fecha radicado</th>
                                                <th class="td-fecrep_sol"> Fecha respuesta</th>
                                                <th class="td-diaspen_sol"> dias pendiente</th>
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
                                            $rec_id = ($data['fec_sol'] ? urlencode($data['fec_sol']) : null);
                                            $counter++;
                                        ?>
                                            <tr>
                                                <!--PageComponentStart-->
                                                <td class="td-rad_sol">
                                                    <?php echo $data['rad_sol']; ?>
                                                </td>
                                                <td class="td-id_asig_sol">
                                                    <?php echo $data['id_asig_sol']; ?>
                                                </td>
                                                <td class="td-nom_ofic_user">
                                                    <?php echo $data['nom_ofic_user']; ?>
                                                </td>
                                                <td class="td-regsol_est">
                                                    <?php echo $data['regsol_est']; ?>
                                                </td>
                                                <td class="td-fec_sol">
                                                    <?php echo $data['fec_sol']; ?>
                                                </td>
                                                <td class="td-fecrep_sol">
                                                    <?php echo $data['fecrep_sol']; ?>
                                                </td>
                                                <td class="td-diaspen_sol">
                                                    <?php echo $data['diaspen_sol']; ?>
                                                </td>
                                                <!--PageComponentEnd-->
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
                                                    <i class="material-icons">block</i> ninguna pqrs vencida
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
                                        </div>
                                        <div class="col">
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
