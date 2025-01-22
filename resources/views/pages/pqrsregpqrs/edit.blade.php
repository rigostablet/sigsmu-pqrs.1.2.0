<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Editar"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                        Notificar 
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">editar pqrs</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pqrsregpqrs/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fec_sol">fecha de solicitud </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-fec_sol-holder" class="input-group ">
                                                <input id="ctrl-fec_sol" data-field="fec_sol" class="form-control datepicker  datepicker"  value="<?php  echo $data['fec_sol']; ?>" type="datetime" name="fec_sol" placeholder="Escribir fecha de solicitud" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fecrep_sol">Fecha de la respuesta </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-fecrep_sol-holder" class="input-group ">
                                                <input id="ctrl-fecrep_sol" data-field="fecrep_sol" class="form-control datepicker  datepicker"  value="<?php  echo $data['fecrep_sol']; ?>" type="datetime" name="fecrep_sol" placeholder="Escribir Fecha de la respuesta" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tip_ent_sol">Clase Entidad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tip_ent_sol-holder" class=" ">
                                                <select required=""  id="ctrl-tip_ent_sol" data-field="tip_ent_sol" data-load-select-options="id_ent_sol" name="tip_ent_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = $comp_model->tip_ent_sol_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['tip_ent_sol'] ? 'selected' : null );
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
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_ent_sol">Tipo entidad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_ent_sol-holder" class=" ">
                                                <select required=""  id="ctrl-id_ent_sol" data-field="id_ent_sol" data-load-path="<?php print_link('componentsdata/id_ent_sol_option_list') ?>" data-load-select-options="id_pet" name="id_ent_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                                <?php
                                                    $options = $comp_model->id_ent_sol_option_list($data['tip_ent_sol']) ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['id_ent_sol'] ? 'selected' : null );
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
                                </div>
                                <div class="form-group col-5">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_pet">Nombre peticionario <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_pet-holder" class=" ">
                                                <select required=""  id="ctrl-id_pet" data-field="id_pet" data-load-path="<?php print_link('componentsdata/id_pet_option_list') ?>" name="id_pet"  placeholder="Seleccione un valor"    class="form-select" >
                                                <?php
                                                    $options = $comp_model->id_pet_option_list($data['id_ent_sol']) ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['id_pet'] ? 'selected' : null );
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
                                </div>
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tip_sol">Tipo de pqrs <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tip_sol-holder" class=" ">
                                                <select required=""  id="ctrl-tip_sol" data-field="tip_sol" name="tip_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = $comp_model->tip_sol_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['tip_sol'] ? 'selected' : null );
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
                                </div>
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="medio_sol">Medio Sol <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-medio_sol-holder" class=" ">
                                                <select required=""  id="ctrl-medio_sol" data-field="medio_sol" name="medio_sol"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = Menu::medioSol();
                                                    $field_value = $data['medio_sol'];
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_record_selected($field_value, $value);
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
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="desc_sol">descripcion de la pqrs <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-desc_sol-holder" class=" ">
                                            <textarea placeholder="Escribir descripcion de la pqrs" id="ctrl-desc_sol" data-field="desc_sol"  required="" rows="5" name="desc_sol" class=" form-control"><?php  echo $data['desc_sol']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                        </div>
                                        <small class="form-text">descripcion corta de la pqrs</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="regsol_photo">soportes <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-regsol_photo-holder" class=" ">
                                            <div class="dropzone required" input="#ctrl-regsol_photo" fieldname="regsol_photo" uploadurl="{{ url('fileuploader/upload/regsol_photo') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="10" maximum="1">
                                                <input name="regsol_photo" id="ctrl-regsol_photo" data-field="regsol_photo" required="" class="dropzone-input form-control" value="<?php  echo $data['regsol_photo']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['regsol_photo'], '#ctrl-regsol_photo', 'true'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="regsol_dias">Dias hábiles asignados <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-regsol_dias-holder" class=" ">
                                                <select required=""  id="ctrl-regsol_dias" data-field="regsol_dias" name="regsol_dias"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = Menu::regsolDias();
                                                    $field_value = $data['regsol_dias'];
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_record_selected($field_value, $value);
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
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="diaspen_sol">Dias faltantes </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-diaspen_sol-holder" class=" ">
                                            <input id="ctrl-diaspen_sol" data-field="diaspen_sol"  value="<?php  echo $data['diaspen_sol']; ?>" type="number" placeholder="Escribir Dias faltantes" step="any"  name="diaspen_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="id_asig_sol">Id Asig Sol <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-id_asig_sol-holder" class=" ">
                                            <input id="ctrl-id_asig_sol" data-field="id_asig_sol"  value="<?php  echo $data['id_asig_sol']; ?>" type="text" placeholder="Escribir Id Asig Sol"  required="" name="id_asig_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nom_ent_sol">Nom Ent Sol <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nom_ent_sol-holder" class=" ">
                                            <input id="ctrl-nom_ent_sol" data-field="nom_ent_sol"  value="<?php  echo $data['nom_ent_sol']; ?>" type="text" placeholder="Escribir Nom Ent Sol"  required="" name="nom_ent_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nom_pet_sol">Nom Pet Sol <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nom_pet_sol-holder" class=" ">
                                            <input id="ctrl-nom_pet_sol" data-field="nom_pet_sol"  value="<?php  echo $data['nom_pet_sol']; ?>" type="text" placeholder="Escribir Nom Pet Sol"  required="" name="nom_pet_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email_sol">Email Sol <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email_sol-holder" class=" ">
                                            <input id="ctrl-email_sol" data-field="email_sol"  value="<?php  echo $data['email_sol']; ?>" type="email" placeholder="Escribir Email Sol"  required="" name="email_sol"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="regsol_est">Regsol Est <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-regsol_est-holder" class=" ">
                                            <input id="ctrl-regsol_est" data-field="regsol_est"  value="<?php  echo $data['regsol_est']; ?>" type="text" placeholder="Escribir Regsol Est"  required="" name="regsol_est"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="usu_sol">usuario activo <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-usu_sol-holder" class=" ">
                                                <input id="ctrl-usu_sol" data-field="usu_sol"  value="<?php  echo $data['usu_sol']; ?>" type="text" placeholder="Escribir usuario activo"  readonly required="" name="usu_sol"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ofic_usu_sol">oficina activa <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ofic_usu_sol-holder" class=" ">
                                                <input id="ctrl-ofic_usu_sol" data-field="ofic_usu_sol"  value="<?php  echo $data['ofic_usu_sol']; ?>" type="text" placeholder="Escribir oficina activa"  readonly required="" name="ofic_usu_sol"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="mun_user_sol">mun_activo <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-mun_user_sol-holder" class=" ">
                                                <input id="ctrl-mun_user_sol" data-field="mun_user_sol"  value="<?php  echo $data['mun_user_sol']; ?>" type="text" placeholder="Escribir mun_activo"  readonly required="" name="mun_user_sol"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="mun_sol">municipio solicitante <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-mun_sol-holder" class=" ">
                                                <input id="ctrl-mun_sol" data-field="mun_sol"  value="<?php  echo $data['mun_sol']; ?>" type="text" placeholder="Escribir municipio solicitante"  readonly required="" name="mun_sol"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Notificar
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
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
