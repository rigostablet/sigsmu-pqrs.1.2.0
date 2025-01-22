<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "registro pqrs"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3 img-form" >
        <div class="container">
            <div class="row img-form">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">registro de pqrs</div>
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
            <div class="row q-col-gutter-md justify-center">
                <div class="col-md-9 comp-grid " >
                    <div  class="card text-lowercase card-1 rounded page-content" >
                        <!--[form-start]-->
                        <form id="pqrsregpqrs-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('pqrsregpqrs.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="control-label" for="fec_sol">fecha de solicitud </label>
                                        <div id="ctrl-fec_sol-holder" class="input-group "> 
                                            <input id="ctrl-fec_sol" data-field="fec_sol" class="form-control datepicker  datepicker"  value="<?php echo get_value('fec_sol') ?>" type="datetime" name="fec_sol" placeholder="Escribir fecha de solicitud" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="control-label" for="tip_ent_sol">Clase Entidad <span class="text-danger">*</span></label>
                                        <div id="ctrl-tip_ent_sol-holder" class=" "> 
                                            <select required=""  id="ctrl-tip_ent_sol" data-field="tip_ent_sol" data-load-select-options="id_ent_sol" name="tip_ent_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->tip_ent_sol_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('tip_ent_sol', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="control-label" for="id_ent_sol">Tipo entidad <span class="text-danger">*</span></label>
                                        <div id="ctrl-id_ent_sol-holder" class=" "> 
                                            <select required=""  id="ctrl-id_ent_sol" data-field="id_ent_sol" data-load-path="<?php print_link('componentsdata/id_ent_sol_option_list') ?>" data-load-select-options="id_pet" name="id_ent_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-5">
                                        <label class="control-label" for="id_pet">Nombre peticionario <span class="text-danger">*</span></label>
                                        <div id="ctrl-id_pet-holder" class=" "> 
                                            <select required=""  id="ctrl-id_pet" data-field="id_pet" data-load-path="<?php print_link('componentsdata/id_pet_option_list') ?>" name="id_pet"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="control-label" for="tip_sol">Tipo de pqrs <span class="text-danger">*</span></label>
                                        <div id="ctrl-tip_sol-holder" class=" "> 
                                            <select required=""  id="ctrl-tip_sol" data-field="tip_sol" name="tip_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->tip_sol_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('tip_sol', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="desc_sol">descripcion de la pqrs <span class="text-danger">*</span></label>
                                    <div id="ctrl-desc_sol-holder" class=" "> 
                                        <textarea placeholder="Escribir descripcion de la pqrs" id="ctrl-desc_sol" data-field="desc_sol"  required="" rows="5" name="desc_sol" class=" form-control"><?php echo get_value('desc_sol') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                    </div>
                                    <small class="form-text">descripcion corta de la pqrs</small>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="regsol_photo">soportes <span class="text-danger">*</span></label>
                                    <div id="ctrl-regsol_photo-holder" class=" "> 
                                        <div class="dropzone required" input="#ctrl-regsol_photo" fieldname="regsol_photo" uploadurl="{{ url('fileuploader/upload/regsol_photo') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="10" maximum="1">
                                            <input name="regsol_photo" id="ctrl-regsol_photo" data-field="regsol_photo" required="" class="dropzone-input form-control" value="<?php echo get_value('regsol_photo') ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label class="control-label" for="regsol_dias">Dias hábiles asignados <span class="text-danger">*</span></label>
                                        <div id="ctrl-regsol_dias-holder" class=" "> 
                                            <select required=""  id="ctrl-regsol_dias" data-field="regsol_dias" name="regsol_dias"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php
                                                $options = Menu::regsolDias();
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_field_selected('regsol_dias', $value, "");
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
                                    <div class="form-group col-4">
                                        <label class="control-label" for="mun_sol">municipio solicitante <span class="text-danger">*</span></label>
                                        <div id="ctrl-mun_sol-holder" class=" "> 
                                            <select required=""  id="ctrl-mun_sol" data-field="mun_sol" name="mun_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->mun_sol_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('mun_sol', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="control-label" for="usu_sol">usuario activo <span class="text-danger">*</span></label>
                                        <div id="ctrl-usu_sol-holder" class=" "> 
                                            <input id="ctrl-usu_sol" data-field="usu_sol"  value="<?php echo get_value('usu_sol', auth()->user()->username) ?>" type="text" placeholder="Escribir usuario activo"  readonly required="" name="usu_sol"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="control-label" for="ofic_usu_sol">Ofic Usu Sol <span class="text-danger">*</span></label>
                                        <div id="ctrl-ofic_usu_sol-holder" class=" "> 
                                            <input id="ctrl-ofic_usu_sol" data-field="ofic_usu_sol"  value="<?php echo get_value('ofic_usu_sol', auth()->user()->oficina) ?>" type="text" placeholder="Escribir Ofic Usu Sol"  readonly required="" name="ofic_usu_sol"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="control-label" for="mun_user_sol">usuario <span class="text-danger">*</span></label>
                                        <div id="ctrl-mun_user_sol-holder" class=" "> 
                                            <input id="ctrl-mun_user_sol" data-field="mun_user_sol"  value="<?php echo get_value('mun_user_sol', auth()->user()->cod_mun) ?>" type="text" placeholder="Escribir usuario"  readonly required="" name="mun_user_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                grabar
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
