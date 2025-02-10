<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("pqrsregpqrs/add");
    $can_edit = $user->canAccess("pqrsregpqrs/edit");
    $can_view = $user->canAccess("pqrsregpqrs/view");
    $can_delete = $user->canAccess("pqrsregpqrs/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "ingreso pqrs"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="page-header"><h4>
            </h4></div>
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">pqrs sin respuesta</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("pqrsregpqrs/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    nueva pqrs 
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
<div  class=" size-font-table" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class="img-form page-content" >
                    <div id="pqrsregpqrs-list-records">
                        <div class="row gutter-lg ">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/pqrsregpqrs/", $field_name, $field_value); ?>
                                    <?php Html::display_page_errors($errors); ?>
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <table class="table table-hover table-sm text-left size-font-table">
                                        <thead class="table-header ">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                <label class="form-check-label">
                                                <input class="toggle-check-all form-check-input" type="checkbox" />
                                                </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-" > </th><th class="td-fec_sol" > fecSol</th>
                                                <th class="td-fecrep_sol" > fecResp</th>
                                                <th class="td-rad_sol" > radicado</th>
                                                <th class="td-tip_sol" > tipSol</th>
                                                <th class="td-nom_ent" > Pqrsent Nom Ent</th>
                                                <th class="td-nom_pet" > nomPet</th>
                                                <th class="td-desc_sol" > des</th>
                                                <th class="td-regsol_dias" > diasAsig</th>
                                                <th class="td-diaspen_sol" > diasPen</th>
                                                <th class="td-regsol_est" > est</th>
                                                <th class="td-usu_sol" > usu</th>
                                                <th class="td-mun_sol" > mun</th>
                                                <th class="td-email_pet" > email</th>
                                                <th class="td-tele_pet" > tel</th>
                                                <th class="td-mun_pet" > mun</th>
                                                <th class="td-dpt_resp" > dpto</th>
                                                <th class="td-regsol_photo" > img</th>
                                                <th class="td-dir_pet" > dir</th>
                                                <th class="td-bar_pet" > bar</th>
                                                <th class="td-dir_ent" > dirEnt</th>
                                                <th class="td-nombre_resp" > nomAsig</th>
                                                <th class="td-date_created" > datCre</th>
                                                <th class="td-date_updated" > datUpd</th>
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
                                                $rec_id = ($data['id_sol'] ? urlencode($data['id_sol']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                    <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id_sol'] ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-masterdetailbtn">
                                                    <a data-page-id="pqrsregpqrs-detail-page" class="btn btn-sm btn-primary btn-size page-modal" href="<?php print_link("pqrsregpqrs/masterdetail/$data[id_sol]"); ?>">
                                                    notificar
                                                </a>
                                            </td>
                                            <td class="td-fec_sol">
                                                <?php echo  $data['fec_sol'] ; ?>
                                            </td>
                                            <td class="td-fecrep_sol">
                                                <?php echo  $data['fecrep_sol'] ; ?>
                                            </td>
                                            <td class="td-rad_sol">
                                                <?php echo  $data['rad_sol'] ; ?>
                                            </td>
                                            <td class="td-tip_sol">
                                                <?php echo  $data['tip_sol'] ; ?>
                                            </td>
                                            <td class="td-pqrsent_nom_ent">
                                                <?php echo  $data['pqrsent_nom_ent'] ; ?>
                                            </td>
                                            <td class="td-pqrspet_nom_pet">
                                                <?php echo  $data['pqrspet_nom_pet'] ; ?>
                                            </td>
                                            <td class="td-desc_sol">
                                                <?php echo  $data['desc_sol'] ; ?>
                                            </td>
                                            <td class="td-regsol_dias">
                                                <?php echo  $data['regsol_dias'] ; ?>
                                            </td>
                                            <td class="td-diaspen_sol">
                                                <?php echo  $data['diaspen_sol'] ; ?>
                                            </td>
                                            <td class="td-regsol_est">
                                                <?php echo  $data['regsol_est'] ; ?>
                                            </td>
                                            <td class="td-usu_sol">
                                                <?php echo  $data['usu_sol'] ; ?>
                                            </td>
                                            <td class="td-mun_sol">
                                                <?php echo  $data['mun_sol'] ; ?>
                                            </td>
                                            <td class="td-pqrspet_email_pet">
                                                <?php echo  $data['pqrspet_email_pet'] ; ?>
                                            </td>
                                            <td class="td-pqrspet_tele_pet">
                                                <?php echo  $data['pqrspet_tele_pet'] ; ?>
                                            </td>
                                            <td class="td-pqrspet_mun_pet">
                                                <?php echo  $data['pqrspet_mun_pet'] ; ?>
                                            </td>
                                            <td class="td-pqrsrespon_dpt_resp">
                                                <?php echo  $data['pqrsrespon_dpt_resp'] ; ?>
                                            </td>
                                            <td class="td-regsol_photo">
                                                <img src="https://sigsmu-pqrs.site/uploads/files/<?php echo basename($data['regsol_photo']); ?>" 
                                                     alt="imagen" 
                                                     style="width: 50px; height: 50px;" 
                                                     onclick="window.open(this.src, '_blank');">
                                            </td>
                                            <td class="td-pqrspet_dir_pet">
                                                <?php echo  $data['pqrspet_dir_pet'] ; ?>
                                            </td>
                                            <td class="td-pqrspet_bar_pet">
                                                <?php echo  $data['pqrspet_bar_pet'] ; ?>
                                            </td>
                                            <td class="td-pqrsent_dir_ent">
                                                <?php echo  $data['pqrsent_dir_ent'] ; ?>
                                            </td>
                                            <td class="td-pqrsrespon_nombre_resp">
                                                <?php echo  $data['pqrsrespon_nombre_resp'] ; ?>
                                            </td>
                                            <td class="td-date_created">
                                                <?php echo  $data['date_created'] ; ?>
                                            </td>
                                            <td class="td-date_updated">
                                                <?php echo  $data['date_updated'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-success btn-size has-tooltip "   title="Editar" href="<?php print_link("pqrsregpqrs/edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> Editar
                                            </a>
                                            <?php } ?>
                                            <!--
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal" title="Borrar" href="<?php print_link("pqrsregpqrs/delete/$rec_id"); ?>" >
                                            <i class="material-icons">delete_sweep</i> Delete
                                        </a>
                                        -->
                                        <?php } ?> 
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
                                        <i class="material-icons">block</i> ningún record fue encontrado
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
                                " data-display-style="modal" data-url="<?php print_link("pqrsregpqrs/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                <!-- Detail Page Column -->
                <?php if(!request()->has('subpage')){ ?>
                <div class="col-12">
                    <div class=" ">
                        <div id="pqrsregpqrs-detail-page" class="master-detail-page"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
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
    <!--pageautofill--><script>
    $(document).ready(function() {
  $('.table tbody tr').each(function() {
    var diasPenValue = parseFloat($(this).find('td.td-diaspen_sol').text());
    if (!isNaN(diasPenValue) && diasPenValue <= 2) {
      $(this).css("color", "#E10516"); // rojo
    }
  });
});
</script>

<script>
$(document).ready(function() {
  $('.table tbody tr').each(function() {
    var diasPenValue = parseFloat($(this).find('td.td-diaspen_sol').text());
    if (!isNaN(diasPenValue) && diasPenValue > 2) {
      $(this).css("color", "#1D6403"); // Verde 
    }
  });
});
</script>
<script>
    //Colorea las filas de gris siempre y cuando el valor del campo "est" sea igual "RESUELTA"

$(document).ready(function() {
    $('.table tbody tr').each(function() {
        var est = $(this).find('td.td-regsol_est').text();
        if (est.trim() === 'RESUELTA') {
            $(this).css("color", "#616161"); // gris 
        }
    });
});

</script>
<!--pageautofill-->
    $(document).ready(function() {
  $('.table tbody tr').each(function() {
    var diasPenValue = parseFloat($(this).find('td.td-diaspen_sol').text());
    if (!isNaN(diasPenValue) && diasPenValue <= 2) {
      $(this).css("color", "#E10516"); // rojo
    }
  });
});

$(document).ready(function() {
  $('.table tbody tr').each(function() {
    var diasPenValue = parseFloat($(this).find('td.td-diaspen_sol').text());
    if (!isNaN(diasPenValue) && diasPenValue > 2) {
      $(this).css("color", "#1D6403"); // Verde 
    }
  });
});

</script>
@endsection
