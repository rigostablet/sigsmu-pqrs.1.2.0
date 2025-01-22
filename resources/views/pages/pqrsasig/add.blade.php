<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Agregar nuevo"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Agregar nuevo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="pqrsasig-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('pqrsasig.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_rad_asig">Radicado pqrs <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_rad_asig-holder" class=" ">
                                                <input id="ctrl-id_rad_asig" data-field="id_rad_asig"  value="<?php echo get_value('id_rad_asig') ?>" type="text" placeholder="Escribir Id Rad Asig"  readonly required="" name="id_rad_asig"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tip_ent_asig">Tipo entidad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tip_ent_asig-holder" class=" ">
                                                <select required=""  id="ctrl-tip_ent_asig" data-field="tip_ent_asig" data-load-select-options="id_ent_asig" name="tip_ent_asig"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = Menu::tipEntAsig();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('tip_ent_asig', $value, "");
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>                                   
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_ent_asig">Oficina: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_ent_asig-holder" class=" ">
                                                <select required=""  id="ctrl-id_ent_asig" data-field="id_ent_asig" data-load-path="<?php print_link('componentsdata/id_ent_asig_option_list') ?>" data-load-select-options="id_resp_asig" name="id_ent_asig"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_resp_asig">Notificar a: </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_resp_asig-holder" class=" ">
                                                <select  id="ctrl-id_resp_asig" data-field="id_resp_asig" data-load-path="<?php print_link('componentsdata/id_resp_asig_option_list') ?>" data-load-select-options="email_asig" name="id_resp_asig"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email_asig">Email de envio </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email_asig-holder" class=" ">
                                                <select  id="ctrl-email_asig" data-field="email_asig" data-load-path="<?php print_link('componentsdata/email_asig_option_list') ?>" name="email_asig"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="observacion">Observacion <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-observacion-holder" class=" ">
                                                <textarea placeholder="Escribir Observacion" id="ctrl-observacion" data-field="observacion"  required="" rows="4" name="observacion" class=" form-control"><?php echo get_value('observacion') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Entregar
                                <i class="material-icons">send</i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
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
    
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
