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
    $pageTitle = "listado total pqrs"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">total pqrs</div>
                    </div>
                </div>
                <div class="col-auto  " >
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
        <div class="container-fluid back-table">
            <div class="row ">
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <div id="pqrsregpqrs-list_pqrs_total_cont_-records">
                            <div id="page-main-content" class="table-responsive">
                                <div class="ajax-page-load-indicator" style="display:none">
                                    <div class="text-center d-flex justify-content-center load-indicator">
                                        <span class="loader mr-3"></span>
                                        <span class="fw-bold">Cargando...</span>
                                    </div>
                                </div>
                                <?php Html::page_bread_crumb("/pqrsregpqrs/list_pqrs_total_cont_", $field_name, $field_value); ?>
                                <?php Html::display_page_errors($errors); ?>
                                <div class="filter-tags mb-2">
                                    <?php Html::filter_tag('search', __('Search')); ?>
                                </div>
                                <table class="table table-hover table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-tipsol_nombre" > Tipo Solicitud</th>
                                            <th class="td-rad_sol" > radicado</th>
                                            <th class="td-fec_sol" > fecha pqrs</th>
                                            <th class="td-fecrep_sol" > respuesta_prog</th>
                                            <th class="td-fec_respu" > respuesta</th>
                                            <th class="td-nom_ent_sol" > nombre entidad</th>
                                            <th class="td-nom_pet_sol" > nombre peticionario</th>
                                            <th class="td-medio_sol" > medio solicitud</th>
                                            <th class="td-desc_sol" > descripcion</th>
                                            <th class="email_pet" > email_petic</th>
                                            <!--<th class="td-email_sol" > email</th> -->
                                            <th class="td-regsol_photo" ><i class="material-icons mi-sm">image</i> soporte</th>
                                            <th class="td-mun_pet" > mun petic</th>
                                            <th class="td-id_asig_sol" > func notif</th>
                                            <th class="td-regsol_dias" > dias asignados</th>
                                            <th class="td-diaspen_sol" > dias pend</th>
                                            <th class="td-regsol_est" > estado pqrs</th>
                                            <th class="td-usu_sol" > usuario activo</th>
                                            <th class="td-nom_ofic_user" > oficina</th>
                                            <th class="td-ofic_usu_sol" > cod_ofic</th>
                                            <th class="td-mun_user_sol" > mun activo</th>
                                            <th class="td-date_created" > Date Created</th>
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
                                            <!--PageComponentStart-->
                                            <td class="td-pqrstipsol_tipsol_nombre">
                                                <?php echo  $data['pqrstipsol_tipsol_nombre'] ; ?>
                                            </td>
                                            <td class="td-rad_sol">
                                                <?php echo  $data['rad_sol'] ; ?>
                                            </td>
                                            <td class="td-fec_sol">
                                                <?php echo  $data['fec_sol'] ; ?>
                                            </td>
                                            <td class="td-fecrep_sol">
                                                <?php echo  $data['fecrep_sol'] ; ?>
                                            </td>
                                            <td class="td-pqrsrespu_fec_respu">
                                                <?php echo  $data['pqrsrespu_fec_respu'] ; ?>
                                            </td>
                                            <td class="td-nom_ent_sol">
                                                <?php echo  $data['nom_ent_sol'] ; ?>
                                            </td>
                                            <td class="td-nom_pet_sol">
                                                <?php echo  $data['nom_pet_sol'] ; ?>
                                            </td>
                                            <td class="td-medio_sol">
                                                <?php echo  $data['medio_sol'] ; ?>
                                            </td>
                                            <td class="td-desc_sol">
                                                <?php echo  $data['desc_sol'] ; ?>
                                            </td>
                                            <td class="td-email_pet">
                                                <?php echo  $data['pqrspet_email_pet'] ; ?>
                                            </td>
                                            <!--
                                            <td class="td-email_sol">
                                                <a href="<?php print_link("mailto:$data[email_sol]") ?>"><?php echo $data['email_sol']; ?></a>
                                            </td>
                                            -->
                                            <!-- Se modifico el codigo a continuacion de la imagen para que abra en una pagina nueva -->
                                    <?php
                                    $baseUrl = url('/uploads/files/');	
					$imageSrc = $baseUrl . '/' . basename($data['regsol_photo']);
					$defaultImage = $baseUrl.'/default.png';
					$pdfPreview =$baseUrl .'/pdf-preview.png';

                                    // Verifica si el archivo es un PDF y ajusta la imagen de vista previa en consecuencia
                                    $fileExtension = pathinfo($data['regsol_photo'], PATHINFO_EXTENSION);
                                    $displayImage = ($fileExtension === 'pdf') ? $pdfPreview : (file_exists($imageSrc) ? $imageSrc : $defaultImage);
                                    ?>

                                    <td class="td-regsol_photo">
                                        <img src="<?php echo $displayImage; ?>" 
                                            alt="imagen previa" 
                                            style="width: 40px; height: 40px;" 
                                            onclick="window.open('<?php echo $imageSrc; ?>', '_blank');">
                                    </td>
                                            <td class="td-pqrsdpto_nom_mun">
                                                <?php echo $data['pqrsdpto_nom_mun']; ?>
                                            </td>
                                                                                        
                                            <td class="td-id_asig_sol">
                                                <?php echo  $data['id_asig_sol'] ; ?>
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
                                            <td class="td-user_nom_ofic_user">
                                                <?php echo  $data['user_nom_ofic_user'] ; ?>
                                            </td>
                                            
                                            <td class="td-ofic_usu_sol">
                                                <?php echo  $data['ofic_usu_sol'] ; ?>
                                            </td>
                        
                                            <td class="td-mun_user_sol">
                                                <?php echo  $data['mun_user_sol'] ; ?>
                                            </td>
                                            <td class="td-date_created">
                                                <?php echo  $data['date_created'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
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
                                        <div class="dropup export-btn-holder">
                                            <button  class="btn  btn-sm btn-outline-primary dropdown-toggle" title="Export" type="button" data-bs-toggle="dropdown">
                                            <i class="material-icons">save</i> Descargar
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <?php Html :: export_menus(['excel']); ?>
                                            </div>
                                        </div>
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
