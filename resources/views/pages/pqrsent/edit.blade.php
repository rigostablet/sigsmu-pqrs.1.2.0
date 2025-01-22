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
                        <div class="h5 font-weight-bold text-primary">editar entidades</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pqrsent/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="tip_ent">Tipo entidad <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-tip_ent-holder" class=" ">
                                            <select required=""  id="ctrl-tip_ent" data-field="tip_ent" name="tip_ent"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php
                                                $options = $comp_model->tip_ent_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['tip_ent'] ? 'selected' : null );
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
                                        <label class="control-label" for="nit_ent">Nit entidad <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nit_ent-holder" class=" ">
                                            <input id="ctrl-nit_ent" data-field="nit_ent"  value="<?php  echo $data['nit_ent']; ?>" type="text" placeholder="Escribir Nit entidad"  required="" name="nit_ent"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nom_ent">Nombre entidad <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nom_ent-holder" class=" ">
                                            <input id="ctrl-nom_ent" data-field="nom_ent"  value="<?php  echo $data['nom_ent']; ?>" type="text" placeholder="Escribir Nombre entidad"  required="" name="nom_ent"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="dir_ent">Dirección entidad </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-dir_ent-holder" class=" ">
                                            <input id="ctrl-dir_ent" data-field="dir_ent"  value="<?php  echo $data['dir_ent']; ?>" type="text" placeholder="Escribir Dirección entidad"  name="dir_ent"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="tel_ent">Telefono entidad </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-tel_ent-holder" class=" ">
                                            <input id="ctrl-tel_ent" data-field="tel_ent"  value="<?php  echo $data['tel_ent']; ?>" type="text" placeholder="Escribir Telefono entidad"  name="tel_ent"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email_ent">Email entidad </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email_ent-holder" class=" ">
                                            <input id="ctrl-email_ent" data-field="email_ent"  value="<?php  echo $data['email_ent']; ?>" type="email" placeholder="Escribir Email entidad"  name="email_ent"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="mun_ent">Municipio entidad </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-mun_ent-holder" class=" ">
                                            <select  id="ctrl-mun_ent" data-field="mun_ent" name="mun_ent"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php
                                                $options = $comp_model->mun_ent_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['mun_ent'] ? 'selected' : null );
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
