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
    <div  class="bg-light p-3 mb-3 back-table" >
        <div class="container">
            <div class=" row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Agregar funcionario</div>
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
                        <form id="pqrsrespon-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('pqrsrespon.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="control-label" for="id_tip_ent">tipo entidad <span class="text-danger">*</span></label>
                                        <div id="ctrl-id_tip_ent-holder" class=" "> 
                                            <select required=""  id="ctrl-id_tip_ent" data-field="id_tip_ent" data-load-select-options="id_ent_resp" name="id_tip_ent" readonly required="" placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->id_tip_ent_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('id_tip_ent', $value, "3");
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
                                        <label class="control-label" for="id_ent_resp">entidad <span class="text-danger">*</span></label>
                                        <div id="ctrl-id_ent_resp-holder" class=" "> 
                                            <select required=""  id="ctrl-id_ent_resp" data-field="id_ent_resp" name="id_ent_resp"  placeholder="Seleccione un valor"  readonly required="" class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->id_ent_resp_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('id_ent_resp', $value, auth()->user()->oficina);
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
                                    <div class="form-group col-6">
                                        <label class="control-label" for="nombre_resp">Nombre funcionario <span class="text-danger">*</span></label>
                                        <div id="ctrl-nombre_resp-holder" class=" "> 
                                            <input id="ctrl-nombre_resp" data-field="nombre_resp"  value="<?php echo get_value('nombre_resp') ?>" type="text" placeholder="Escribir Nombre funcionario"  required="" name="nombre_resp"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-5">
                                        <label class="control-label" for="cargo_resp">cargo <span class="text-danger">*</span></label>
                                        <div id="ctrl-cargo_resp-holder" class=" "> 
                                            <select required=""  id="ctrl-cargo_resp" data-field="cargo_resp" name="cargo_resp"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                                $options = $comp_model->carg_pet_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('cargo_resp', $value, "");
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
                                        <label class="control-label" for="email_resp">email <span class="text-danger">*</span></label>
                                        <div id="ctrl-email_resp-holder" class=" "> 
                                            <input id="ctrl-email_resp" data-field="email_resp"  value="<?php echo get_value('email_resp') ?>" type="email" placeholder="Escribir email"  required="" name="email_resp"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="control-label" for="tel_resp">telefono <span class="text-danger">*</span></label>
                                        <div id="ctrl-tel_resp-holder" class=" "> 
                                            <input id="ctrl-tel_resp" data-field="tel_resp"  value="<?php echo get_value('tel_resp') ?>" type="text" placeholder="Escribir telefono"  required="" name="tel_resp"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="control-label" for="mun_resp">municipio <span class="text-danger">*</span></label>
                                        <div id="ctrl-mun_resp-holder" class=" "> 
                                            <input id="ctrl-mun_resp" data-field="mun_resp"  value="<?php echo get_value('mun_resp', auth()->user()->mun) ?>" type="text" placeholder="Escribir municipio" readonly required="" name="mun_resp"  class="form-control " />
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label class="control-label" for="dpt_resp">departamento <span class="text-danger">*</span></label>
                                        <div id="ctrl-mun_resp-holder" class=" "> 
                                            <input id="ctrl-dpt_resp" data-field="dpt_resp"  value="<?php echo get_value('dpt_resp', auth()->user()->dpto_user) ?>" type="text" placeholder="Escribir municipio" readonly required="" name="dpt_resp"  class="form-control " />
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
