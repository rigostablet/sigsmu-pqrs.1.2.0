<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "contratista"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3 back-table" >
        <div class="container-fluid ">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="">
                        <div class="h5 font-weight-bold">contratista: <span>Hola ! <?php echo get_value('usuario', auth()->user()->fullname) ?> !</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-2 comp-grid " >
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("pqrsregpqrs/add_pqrs_contrat") ?>"  class="btn btn-block btn-primary alert animated zoomIn open-page-modal" >
                    Ingresar pqrs 
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
        <div class="col-md-2 comp-grid " >
            <a  class="btn btn-success alert animated zoomIn btn-block" href="<?php print_link("pqrsregpqrs/list_pqrs_total_cont_") ?>" >
            Lista pqrs 
        </a>
    </div>
    <div class="col-md-4 comp-grid " >
        <a  class="btn btn-warning alert animated zoomIn btn-block" href="<?php print_link("pqrspet/add") ?>" >
        Ingresar Peticionario 
    </a>
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
