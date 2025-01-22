<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Agregar peticionario"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3 back-table" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a  class="btn " href="<?php print_link("pqrspet") ?>" >
                    <i class="material-icons">arrow_back</i>                                
                </a>
            </div>
            <div class="col  " >
                <div class="">
                    <div class="h5 font-weight-bold text-primary">Agregar peticionario</div>
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
                    <form id="pqrspet-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('pqrspet.store') }}" method="post">
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="id_ent">Tipo Entidad <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-id_ent-holder" class=" ">
                                            <select required=""  id="ctrl-id_ent" data-field="id_ent" data-load-select-options="pet_ent" name="id_ent"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->id_ent_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('id_ent', $value, "");
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="pet_ent">Nombre entidad <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-pet_ent-holder" class=" ">
                                            <select required=""  id="ctrl-pet_ent" data-field="pet_ent" data-load-path="<?php print_link('componentsdata/pet_ent_option_list') ?>" name="pet_ent"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="pet_tipdoc">Tipo documento <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-pet_tipdoc-holder" class=" ">
                                            <select required=""  id="ctrl-pet_tipdoc" data-field="pet_tipdoc" name="pet_tipdoc"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->pet_tipdoc_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('pet_tipdoc', $value, "NA");
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="pet_numpet">numero documento <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-pet_numpet-holder" class=" ">
                                            <input id="ctrl-pet_numpet" data-field="pet_numpet"  value="<?php echo get_value('pet_numpet', "0") ?>" type="number" placeholder="Escribir numero documento" step="any"  required="" name="pet_numpet" data-url="componentsdata/pqrs_pet_pet_numpet_value_exist/" data-loading-msg="Comprobando dcmto..." data-available-msg="Disponible" data-unavailable-msg="documento ya existe" class="form-control  ctrl-check-duplicate " />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nom_pet">nombre peticionario <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nom_pet-holder" class=" ">
                                            <input id="ctrl-nom_pet" data-field="nom_pet"  value="<?php echo get_value('nom_pet') ?>" type="text" placeholder="Escribir nombre peticionario"  required="" name="nom_pet"  class="form-control " />
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="carg_pet">cargo <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-carg_pet-holder" class=" ">
                                            <select required=""  id="ctrl-carg_pet" data-field="carg_pet" name="carg_pet"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->carg_pet_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('carg_pet', $value, "1");
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="dir_pet">direccion <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-dir_pet-holder" class=" ">
                                            <input id="ctrl-dir_pet" data-field="dir_pet"  value="<?php echo get_value('dir_pet', "NA") ?>" type="text" placeholder="Escribir dirccion"  required="" name="dir_pet"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="bar_pet">barrio <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-bar_pet-holder" class=" ">
                                            <input id="ctrl-bar_pet" data-field="bar_pet"  value="<?php echo get_value('bar_pet', "NA") ?>" type="text" placeholder="Escribir barrio"  required="" name="bar_pet"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email_pet">email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email_pet-holder" class=" ">
                                            <input id="ctrl-email_pet" data-field="email_pet"  value="<?php echo get_value('email_pet', "na@na.com") ?>" type="email" placeholder="Escribir email"  required="" name="email_pet"  data-url="componentsdata/pqrspet_email_pet_value_exist/" data-loading-msg="Comprobando disponibilidad ..." data-available-msg="Disponible" data-unavailable-msg="No disponible" class="form-control  ctrl-check-duplicate" />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="tele_pet">telefono <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-tele_pet-holder" class=" ">
                                            <input id="ctrl-tele_pet" data-field="tele_pet"  value="<?php echo get_value('tele_pet', "NA") ?>" type="text" placeholder="Escribir telefono"  required="" name="tele_pet"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="dpto_pet">Dpto Pet <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-dpto_pet-holder" class=" ">
                                            <select required=""  id="ctrl-dpto_pet" data-field="dpto_pet" data-load-select-options="mun_pet" name="dpto_pet"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->dpto_pet_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('dpto_pet', $value, "100");
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="mun_pet">municipio <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-mun_pet-holder" class=" ">
                                            <select required=""  id="ctrl-mun_pet" data-field="mun_pet" data-load-path="<?php print_link('componentsdata/mun_pet_option_list') ?>" name="mun_pet"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="1000">1000</option>
                                            <option value="">Seleccione un valor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="mun_usu_pet">mun activo <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-mun_usu_pet-holder" class=" ">
                                            <input id="ctrl-mun_usu_pet" data-field="mun_usu_pet"  value="<?php echo get_value('mun_usu_pet', auth()->user()->mun) ?>" type="text" placeholder="Escribir mun activo"  readonly required="" name="mun_usu_pet"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="usuario">usuario <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-usuario-holder" class=" ">
                                            <input id="ctrl-usuario" data-field="usuario"  value="<?php echo get_value('usuario', auth()->user()->username) ?>" type="text" placeholder="Escribir usuario"  readonly required="" name="usuario"  class="form-control " />
                                        </div>
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
	 // Ocultar los elementos al cargar la página
     $("#ctrl-nom_pet").show();//muestra el campo nombre peticionario
        $("label[for='nom_pet']").show();// muestra la etiqueta del campo nombre peticionario
        $("#ctrl-carg_pet").hide(); // oculta campo cargo
        $("label[for='carg_pet']").hide(); //oculta label campo cargo
        $("#ctrl-mun_pet").hide();
        $("label[for='mun_pet']").hide();
        $("#ctrl-dpto_pet").hide();
        $("label[for='dpto_pet']").hide();
        $("#ctrl-id_ent").on('change', function() { 
            if ($("#ctrl-id_ent").val()!=3) { //para verificar el valor del campo
                $("#ctrl-pet_ent").show(); // muestra campo entidad
                $("label[for='pet_ent']").show(); // muestra campo entidad
                $("#ctrl-nom_pet").show();
                $("label[for='nom_pet']").show();
                $("#ctrl-pet_numpet").show();
                $("label[for='pet_numpet']").show();
                $("#ctrl-pet_tipdoc").show();
                $("label[for='pet_tipdoc']").show();
                $("#ctrl-dir_pet").show();
                $("label[for='dir_pet']").show();
                $("#ctrl-bar_pet").show();
                $("label[for='bar_pet']").show();
                $("#ctrl-tele_pet").show();
                $("label[for='tele_pet']").show();
                $("#ctrl-carg_pet").hide();
                $("label[for='carg_pet']").hide();
                $("#ctrl-mun_pet").show();
                $("label[for='mun_pet']").show();
				$("#ctrl-dpto_pet").show();
                $("label[for='dpto_pet']").show();
				
                    } else {
                        $("#ctrl-pet_numpet").hide();
                        $("label[for='pet_numpet']").hide();
                        $("#ctrl-pet_tipdoc").hide();
                        $("label[for='pet_tipdoc']").hide();
                        $("#ctrl-nom_pet").show();
                        $("label[for='nom_pet']").show();
                        $("#ctrl-bar_pet").hide();
                        $("label[for='bar_pet']").hide();
                        $("#ctrl-dir_pet").hide();
                        $("label[for='dir_pet']").hide();
                        $("#ctrl-tele_pet").show();
                        $("label[for='tele_pet']").show();
                        $("#ctrl-email_pet").show();
                        $("label[for='email_pet']").show();
                        $("#ctrl-carg_pet").show();
                        $("label[for='carg_pet']").show();
                        $("#ctrl-dpto_pet").hide();
                        $("label[for='dpto_pet']").hide();
                        $("#ctrl-mun_pet").hide();
                        $("label[for='mun_pet']").hide();
						
                    } 
            });
});

</script>
@endsection
