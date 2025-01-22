<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("user/add");
    $can_edit = $user->canAccess("user/edit");
    $can_view = $user->canAccess("user/view");
    $can_delete = $user->canAccess("user/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "User"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page ajax-page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">User</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("user/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    Agregar nuevo 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Buscar" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="user-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <div class="ajax-page-load-indicator" style="display:none">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="fw-bold">Cargando...</span>
                                </div>
                            </div>
                            <?php Html::page_bread_crumb("/user/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <?php } ?>
                                        <th class="td-iduser" > Iduser</th>
                                        <th class="td-username" > Username</th>
                                        <th class="td-phone" > Phone</th>
                                        <th class="td-email" > Email</th>
                                        <th class="td-photo" > Photo</th>
                                        <th class="td-fullname" > Fullname</th>
                                        <th class="td-role" > Role</th>
                                        <th class="td-mun" > Mun</th>
                                        <th class="td-photo_mun" > Photo Mun</th>
                                        <th class="td-user_role_id" > User Role Id</th>
                                        <th class="td-date_created" > Date Created</th>
                                        <th class="td-date_updated" > Date Updated</th>
                                        <th class="td-email_verified_at" > Email Verified At</th>
                                        <th class="td-account_status" > Account Status</th>
                                        <th class="td-cod_mun" > Cod Mun</th>
                                        <th class="td-dpto_user" > Dpto User</th>
                                        <th class="td-oficina" > Oficina</th>
                                        <th class="td-nom_ofic_user" > Nom Ofic User</th>
                                        <th class="td-btn"></th>
                                    </tr>
                                </thead>
                                <?php
                                    if($total_records){
                                ?>
                                <tbody class="page-data">
                                    <!--record-->
                                    <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['iduser'] ? urlencode($data['iduser']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['iduser'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                        <!--PageComponentStart-->
                                        <td class="td-iduser">
                                            <a href="<?php print_link("/user/view/$data[iduser]") ?>"><?php echo $data['iduser']; ?></a>
                                        </td>
                                        <td class="td-username">
                                            <?php echo  $data['username'] ; ?>
                                        </td>
                                        <td class="td-phone">
                                            <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                        </td>
                                        <td class="td-email">
                                            <a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a>
                                        </td>
                                        <td class="td-photo">
                                            <?php 
                                                Html :: page_img($data['photo'], '50px', '50px', "small", 1); 
                                            ?>
                                        </td>
                                        <td class="td-fullname">
                                            <?php echo  $data['fullname'] ; ?>
                                        </td>
                                        <td class="td-role">
                                            <?php echo  $data['role'] ; ?>
                                        </td>
                                        <td class="td-mun">
                                            <?php echo  $data['mun'] ; ?>
                                        </td>
                                        <td class="td-photo_mun">
                                            <?php 
                                                Html :: page_img($data['photo_mun'], '50px', '50px', "small", 1); 
                                            ?>
                                        </td>
                                        <td class="td-user_role_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("roles/view/$data[user_role_id]?subpage=1") ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Roles" ?>
                                        </a>
                                    </td>
                                    <td class="td-date_created">
                                        <?php echo  $data['date_created'] ; ?>
                                    </td>
                                    <td class="td-date_updated">
                                        <?php echo  $data['date_updated'] ; ?>
                                    </td>
                                    <td class="td-email_verified_at">
                                        <a href="<?php print_link("mailto:$data[email_verified_at]") ?>"><?php echo $data['email_verified_at']; ?></a>
                                    </td>
                                    <td class="td-account_status">
                                        <?php echo  $data['account_status'] ; ?>
                                    </td>
                                    <td class="td-cod_mun">
                                        <?php echo  $data['cod_mun'] ; ?>
                                    </td>
                                    <td class="td-dpto_user">
                                        <?php echo  $data['dpto_user'] ; ?>
                                    </td>
                                    <td class="td-oficina">
                                        <?php echo  $data['oficina'] ; ?>
                                    </td>
                                    <td class="td-nom_ofic_user">
                                        <?php echo  $data['nom_ofic_user'] ; ?>
                                    </td>
                                    <!--PageComponentEnd-->
                                    <td class="td-btn">
                                        <div class="dropdown" >
                                            <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                            <i class="material-icons">menu</i> 
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($can_view){ ?>
                                                <a class="dropdown-item "   href="<?php print_link("user/view/$rec_id"); ?>" >
                                                <i class="material-icons">visibility</i> View
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("user/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> Edit
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="dropdown-item record-delete-btn" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal" href="<?php print_link("user/delete/$rec_id"); ?>" >
                                        <i class="material-icons">delete_sweep</i> Delete
                                    </a>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                    <!--endrecord-->
                </tbody>
                <tbody class="search-data"></tbody>
                <?php
                    }
                    else{
                ?>
                <tbody class="page-data">
                    <tr>
                        <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                            <i class="material-icons">block</i> ningún registro fue encontrado
                        </td>
                    </tr>
                </tbody>
                <?php
                    }
                ?>
            </table>
        </div>
        <?php
            if($show_footer){
        ?>
        <div class=" mt-3">
            <div class="row align-items-center justify-content-between">    
                <div class="col-md-auto d-flex">    
                    <?php if($can_delete){ ?>
                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?
                    " data-display-style="modal" data-url="<?php print_link("user/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                    <i class="material-icons">delete_sweep</i> Eliminar seleccionado
                    </button>
                    <?php } ?>
                </div>
                <div class="col">   
                    <?php
                        if($show_pagination == true){
                        $pager = new Pagination($total_records, $record_count);
                        $pager->show_page_count = false;
                        $pager->show_record_count = true;
                        $pager->show_page_limit =false;
                        $pager->limit = $limit;
                        $pager->show_page_number_list = true;
                        $pager->pager_link_range=5;
                        $pager->ajax_page = true;
                        $pager->render();
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
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
