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
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">editar responsables</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pqrsrespon/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_tip_ent">tipo entidad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_tip_ent-holder" class=" ">
                                                <select required=""  id="ctrl-id_tip_ent" data-field="id_tip_ent" data-load-select-options="id_ent_resp" name="id_tip_ent"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = $comp_model->id_tip_ent_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['id_tip_ent'] ? 'selected' : null );
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
                                            <label class="control-label" for="id_ent_resp">entidad <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_ent_resp-holder" class=" ">
                                                <select required=""  id="ctrl-id_ent_resp" data-field="id_ent_resp" data-load-path="<?php print_link('componentsdata/id_ent_resp_option_list') ?>" name="id_ent_resp"  placeholder="Seleccione un valor"    class="form-select" >
                                                <?php
                                                    $options = $comp_model->id_ent_resp_option_list($data['id_tip_ent']) ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['id_ent_resp'] ? 'selected' : null );
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
                                <div class="form-group col-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nombre_resp">Nombre funcionario <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nombre_resp-holder" class=" ">
                                                <input id="ctrl-nombre_resp" data-field="nombre_resp"  value="<?php  echo $data['nombre_resp']; ?>" type="text" placeholder="Escribir Nombre funcionario"  required="" name="nombre_resp"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="cargo_resp">cargo <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-cargo_resp-holder" class=" ">
                                                <select required=""  id="ctrl-cargo_resp" data-field="cargo_resp" name="cargo_resp"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = $comp_model->carg_pet_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['cargo_resp'] ? 'selected' : null );
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
                                            <label class="control-label" for="email_resp">email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email_resp-holder" class=" ">
                                                <input id="ctrl-email_resp" data-field="email_resp"  value="<?php  echo $data['email_resp']; ?>" type="email" placeholder="Escribir email"  required="" name="email_resp"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tel_resp">telefono <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tel_resp-holder" class=" ">
                                                <input id="ctrl-tel_resp" data-field="tel_resp"  value="<?php  echo $data['tel_resp']; ?>" type="text" placeholder="Escribir telefono"  required="" name="tel_resp"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="mun_resp">municipio <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-mun_resp-holder" class=" ">
                                                <input id="ctrl-mun_resp" data-field="mun_resp"  value="<?php  echo $data['mun_resp']; ?>" type="text" placeholder="Escribir municipio"  required="" name="mun_resp"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="dpt_resp">dpto <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-dpt_resp-holder" class=" ">
                                                <select required=""  id="ctrl-dpt_resp" data-field="dpt_resp" name="dpt_resp"  placeholder="Seleccione un valor"    class="form-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                    $options = $comp_model->dpt_resp_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['dpt_resp'] ? 'selected' : null );
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
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Actualizar
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
