<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
?>
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("account/edit"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="username">Username <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-username-holder" class=" ">
                                            <input id="ctrl-username" data-field="username"  value="<?php  echo $data['username']; ?>" type="text" placeholder="Escribir Username"  required="" name="username"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="phone">Phone <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-phone-holder" class=" ">
                                            <input id="ctrl-phone" data-field="phone"  value="<?php  echo $data['phone']; ?>" type="text" placeholder="Escribir Phone"  required="" name="phone"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="photo">Photo <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-photo-holder" class=" ">
                                            <div class="dropzone required" input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="photo" id="ctrl-photo" data-field="photo" required="" class="dropzone-input form-control" value="<?php  echo $data['photo']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['photo'], '#ctrl-photo'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="fullname">Fullname <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-fullname-holder" class=" ">
                                            <input id="ctrl-fullname" data-field="fullname"  value="<?php  echo $data['fullname']; ?>" type="text" placeholder="Escribir Fullname"  required="" name="fullname"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="role">Role <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-role-holder" class=" ">
                                            <input id="ctrl-role" data-field="role"  value="<?php  echo $data['role']; ?>" type="text" placeholder="Escribir Role"  required="" name="role"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="mun">Mun </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-mun-holder" class=" ">
                                            <input id="ctrl-mun" data-field="mun"  value="<?php  echo $data['mun']; ?>" type="text" placeholder="Escribir Mun"  name="mun"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="photo_mun">Photo Mun </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-photo_mun-holder" class=" ">
                                            <div class="dropzone " input="#ctrl-photo_mun" fieldname="photo_mun" uploadurl="{{ url('fileuploader/upload/photo_mun') }}"    data-multiple="false" dropmsg="Elija archivos o suelte archivos aquí"    btntext="Vistazo" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="photo_mun" id="ctrl-photo_mun" data-field="photo_mun" class="dropzone-input form-control" value="<?php  echo $data['photo_mun']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor un archivo de elegir</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['photo_mun'], '#ctrl-photo_mun'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="user_role_id">User Role Id </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-user_role_id-holder" class=" ">
                                            <select  id="ctrl-user_role_id" data-field="user_role_id" name="user_role_id"  placeholder="Seleccione un valor"    class="form-select" >
                                            <option value="">Seleccione un valor</option>
                                            <?php
                                                $options = $comp_model->role_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['user_role_id'] ? 'selected' : null );
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
                                        <label class="control-label" for="email_verified_at">Email Verified At </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email_verified_at-holder" class="input-group ">
                                            <input id="ctrl-email_verified_at" data-field="email_verified_at" class="form-control datepicker  datepicker" value="<?php  echo $data['email_verified_at']; ?>" type="datetime"  name="email_verified_at" placeholder="Escribir Email Verified At" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="account_status">Account Status </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-account_status-holder" class=" ">
                                            <input id="ctrl-account_status" data-field="account_status"  value="<?php  echo $data['account_status']; ?>" type="text" placeholder="Escribir Account Status"  name="account_status"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="cod_mun">Cod Mun </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-cod_mun-holder" class=" ">
                                            <input id="ctrl-cod_mun" data-field="cod_mun"  value="<?php  echo $data['cod_mun']; ?>" type="text" placeholder="Escribir Cod Mun"  name="cod_mun"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="dpto_user">Dpto User </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-dpto_user-holder" class=" ">
                                            <input id="ctrl-dpto_user" data-field="dpto_user"  value="<?php  echo $data['dpto_user']; ?>" type="text" placeholder="Escribir Dpto User"  name="dpto_user"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="oficina">Oficina <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-oficina-holder" class=" ">
                                            <input id="ctrl-oficina" data-field="oficina"  value="<?php  echo $data['oficina']; ?>" type="text" placeholder="Escribir Oficina"  required="" name="oficina"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nom_ofic_user">Nom Ofic User <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nom_ofic_user-holder" class=" ">
                                            <input id="ctrl-nom_ofic_user" data-field="nom_ofic_user"  value="<?php  echo $data['nom_ofic_user']; ?>" type="text" placeholder="Escribir Nom Ofic User"  required="" name="nom_ofic_user"  class="form-control " />
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
