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
                        <form id="users-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-name-holder" class=" ">
                                                <input id="ctrl-name" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="Escribir Name"  required="" name="name"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email-holder" class=" ">
                                                <input id="ctrl-email" data-field="email"  value="<?php echo get_value('email') ?>" type="email" placeholder="Escribir Email"  required="" name="email"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email_verified_at">Email Verified At </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email_verified_at-holder" class="input-group ">
                                                <input id="ctrl-email_verified_at" data-field="email_verified_at" class="form-control datepicker  datepicker" value="<?php echo get_value('email_verified_at') ?>" type="datetime"  name="email_verified_at" placeholder="Escribir Email Verified At" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-password-holder" class="input-group ">
                                                <input id="ctrl-password" data-field="password"  value="<?php echo get_value('password') ?>" type="password" placeholder="Escribir Password"  required="" name="password"  class="form-control  password password-strength" />
                                                <button type="button" class="btn btn-outline-secondary btn-toggle-password">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                            </div>
                                            <div class="password-strength-msg">
                                                <small class="fw-bold">Debería contener</small>
                                                <small class="length chip">6 caracteres min</small>
                                                <small class="caps chip">Letra mayúscula</small>
                                                <small class="number chip">Número</small>
                                                <small class="special chip">Símbolo</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-confirm_password-holder" class="input-group ">
                                                <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="Confirm Password" />
                                                <button type="button" class="btn btn-outline-secondary btn-toggle-password">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                <div class="invalid-feedback">
                                                    Password does not match
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="remember_token">Remember Token </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-remember_token-holder" class=" ">
                                                <input id="ctrl-remember_token" data-field="remember_token"  value="<?php echo get_value('remember_token') ?>" type="text" placeholder="Escribir Remember Token"  name="remember_token"  class="form-control " />
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
