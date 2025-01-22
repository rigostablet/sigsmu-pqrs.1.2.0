<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Digitador"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 comp-grid " >
                    <div class="text-center shadow-4">
                        <div class="font-weight-bold h5 text-center">GESTION PQRS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="img-form" >
        <div class="container-fluid contenedor">
            <div class="row contenedor">
                <div class="col-sm-3 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_sinnotificar();  ?>
                    <a class="animated zoomIn record-count alert color-caja-sinasig "  href='<?php print_link("pqrsregpqrs/pqrs_sin_asignar") ?>' >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons mi-sm">list</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">sin notificar</div>
                                <small class=""></small>
                            </div>
                            <h2 class="value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 comp-grid " >
                <?php $rec_count = $comp_model->getcount_sinresponder();  ?>
                <a class="animated zoomIn record-count alert color-caja-sinresp"  href='<?php print_link("pqrsregpqrs/pqrs_asignados") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons mi-sm">list</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">sin responder</div>
                            <small class=""></small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-3 comp-grid " >
            <?php $rec_count = $comp_model->getcount_respuestas();  ?>
            <a class="animated zoomIn record-count alert color-caja-respon"  href='<?php print_link("pqrsregpqrs/pqrs_respond") ?>' >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons mi-sm">list</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">respuestas</div>
                        <small class=""></small>
                    </div>
                    <h2 class="value"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 comp-grid " >
        <?php $rec_count = $comp_model->getcount_totalpqrs();  ?>
        <a class="animated zoomIn record-count alert color-caja-pqrs"  href='<?php print_link("pqrsregpqrs") ?>' >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons mi-sm">list</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">total pqrs</div>
                    <small class=""></small>
                </div>
                <h2 class="value"><?php echo $rec_count; ?></h2>
            </div>
        </div>
    </a>
</div>
</div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12 comp-grid " >
                <div class="">
                    <div class="font-weight-bold h5 text-center">INGRESOS DE DATOS BASICOS</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div  class="mb-3" >
    <div class="container-fluid contenedor">
        <div class="row contenedor">
            <div class="col-lg-12 comp-grid " >
                <?php $modal_id = "modal-" . random_str(); ?>
                <a href="<?php print_link("pqrsregpqrs/add") ?>"  class="btn btn-info btn-block open-page-modal" >
                <i class="material-icons mi-sm">featured_play_list</i>                                  
                ingresar pqrs 
            </a>
            <div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0 ">
                    </div>
                    <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div>
        <a  class="btn btn-info btn-md btn-block" href="<?php print_link("pqrspet/add") ?>" >
        <i class="material-icons mi-sm">featured_play_list</i>                              
        ingresar peticionario 
    </a>
    <a  class="btn btn-info btn-block" href="<?php print_link("pqrsent/add") ?>" >
    <i class="material-icons mi-sm">featured_play_list</i>                              
    Ingresar Entidad 
</a>
<?php $modal_id = "modal-" . random_str(); ?>
<a href="<?php print_link("pqrsrespon/add") ?>"  class="btn btn-info btn-md btn-block open-page-modal" >
<i class="material-icons mi-sm">featured_play_list</i>                                  
Ingresar Funcionario 
</a>
<div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body p-0 ">
        </div>
        <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
        </div>
    </div>
</div>
</div>
<?php $modal_id = "modal-" . random_str(); ?>
<a href="<?php print_link("pqrsmun/add") ?>"  class="btn btn-info btn-block open-page-modal" >
<i class="material-icons mi-sm">featured_play_list</i>                                  
Ingreso municipios 
</a>
<div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body p-0 ">
        </div>
        <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12 comp-grid " style=".detal-izq {
                display: flex;
                align-self: flex-end;
                }">
                <div class="">
                    <div class="font-weight-bold h5 text-center">PQRS VENCIDAS O POR VENCER</div>
                </div>
                <div class=" ">
                    <?php
                        $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 100]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("detalleven/index?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="ajax-page-load-indicator">
                            <div class="text-center d-flex justify-content-center load-indicator">
                                <span class="loader mr-3"></span>
                                <span class="fw-bold">Cargando...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    $(document).ready(function(){
    // custom javascript | jquery codes
    });
</script>
@endsection
