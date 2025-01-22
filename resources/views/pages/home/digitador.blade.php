<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Dashboard Digitador"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="" >
         <div class="container-fluid">
            <div class="row ">
                <div class="col-12 comp-grid " >
                    <div class=" text-center shadow-4">
                        <div class="back-table alert h5 font-weight-bold text-primary text-center">GESTION <i class="material-icons text-primary"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="" >
        <div class="container-fluid contenedor">
            <div class="row contenedor">
                <div class="col-sm-3 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_sinnotificar();  ?>
                    <a class="animated zoomIn record-count alert color-caja-sinasig text-light "  href='<?php print_link("pqrsregpqrs/pqrs_sin_asignar") ?>' title="pqrs registradas que no han sido asginadas" >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons mi-sm">list</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">SIN ASIGNAR</div>
                                <small class="">PQRS ingresadas y sin asignar</small>
                            </div>
                            <h2 class="text-light value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 comp-grid " >
                <?php $rec_count = $comp_model->getcount_sinresponder();  ?>
                <a class="animated zoomIn record-count alert color-caja-sinresp text-light"  href='<?php print_link("pqrsregpqrs/pqrs_asignados") ?>' title="pqrs asignadas sin responder" >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons mi-sm">list</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">SIN RESPUESTAS</div>
                            <small class="">PQRS asignadas sin respuesta</small>
                        </div>
                        <h2 class="text-light value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-3 comp-grid " >
            <?php $rec_count = $comp_model->getcount_respuestas();  ?>
            <a class="animated zoomIn record-count alert color-caja-respon text-light"  href='<?php print_link("pqrsregpqrs/pqrs_respond") ?>' title="pqrs que han sido respondidas" >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons mi-sm">list</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">RESPONDIDAS</div>
                        <small class="">Respuestas realizadas...</small>
                    </div>
                    <h2 class="value text-light"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 comp-grid " >
        <?php $rec_count = $comp_model->getcount_totalpqrs();  ?>
        <a class="animated zoomIn record-count alert color-caja-pqrs text-light"  href='<?php print_link("pqrsregpqrs") ?>' title="total de pqrs de la oficina" >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons mi-sm">list</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">TOTAL PQRS </div>
                    <small class="">Total de PQRS de la oficina</small>
                </div>
                <h2 class="value text-light"><?php echo $rec_count; ?></h2>
            </div>
        </div>
    </a>
</div>
</div>
</div>
</div>
<div  class="border mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12" >
                <div class="">
                    <div class="btn-light alert font-weight-bold h5 text-primary text-center">ACCIONES</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div  class="" >
    <div class="container-fluid">
        <div class="row contenedor">
            <div class="col-sm-2 comp-grid " >
                <?php $modal_id = "modal-" . random_str(); ?>
                <a href="<?php print_link("pqrsregpqrs/add") ?>"  class="btn-success btn-block record-count animated zoomIn alert text-light open-page-modal" title="Ingreso de nueva pqrs" >
                <i class="material-icons mi-xxs">library_books</i>                                   
                <div class="title">Ingrese nueva pqrs</div>
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
    <div class="col-sm-2 comp-grid " >
        <a  class="color-caja-sinasig btn-block record-count animated bounceIn alert text-light" href="<?php print_link("pqrspet/index") ?>" title="Ingreso de nuevos peticionarios" >
        <i class="material-icons mi-xxs">people_outline</i>                              
        <div class="title">Ingrese Peticionario</div>
    </a>
</div>
<div class="col-sm-2 comp-grid " >
    <?php $modal_id = "modal-" . random_str(); ?>
    <a href="<?php print_link("pqrsrespon/add") ?>"  class="btn-warning btn-block record-count animated bounceIn alert text-light open-page-modal" title="Ingreso de funcionarios responsables de las pqrs" >
    <i class="material-icons mi-sm">person_outline</i>                                  
    <div class="title">Ingrese Funcionarios</div> 
</a>

<!-- CODIGO VENTANA MODAL  -->
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
<div class="col-sm-2 comp-grid " >
    <a  class="btn-success btn-block record-count animated bounceIn alert text-light" href="<?php print_link("pqrsmun/add") ?>" title="Ingreso de nuevos municipios" >
        <i class="material-icons ">location_city</i>                                
        <div class="title">Ingrese Municipios</div>
    </a>
    <!-- AGREGADO PARA EL FORMULARIO MODAL -->
</div>

<div class="col-sm-2 comp-grid " >
    <a  class="btn-primary btn-block record-count animated bounceIn alert text-light" href="<?php print_link("pqrsent/index") ?>" title="Ingreso de entidades solicitantes u oficinas municipales" >
    <i class="material-icons mi-sm">location_city</i>                               
    <div class="title">Ingrese Entidades</div> 
</a>
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
                    <div class="btn-light alert font-weight-bold h5 text-primary text-center">ESTADOS</div>
                </div>
                <hr />
            </div>
            <div class=" col-md-12 comp-grid " >
                <div class="">
                    <?php
                        $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 100]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("detalleven/index?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="animated wobble ajax-page-load-indicator">
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
