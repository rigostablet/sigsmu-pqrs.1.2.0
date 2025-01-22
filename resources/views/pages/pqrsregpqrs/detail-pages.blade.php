    <?php
        $rec_id = $masterRecordId ?? null;
        $page_id = "tab-".random_str(6);
    ?>
    <div class="master-detail-page card">
        <div class="p-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#pqrsasig_<?php echo $page_id ?>" class="nav-link active">
                    notificar
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="tab" href="#notpqrs_<?php echo $page_id ?>" class="nav-link ">
                Notificaciones
            </a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane fade show active" id="pqrsasig_<?php echo $page_id ?>" role="tabpanel">
    <div class=" ">
        <?php
            $params = ['id_rad_asig' => $rec_id,'show_header' => false]; //new query param
            $query = array_merge(request()->query(), $params);
            $queryParams = http_build_query($query);
            $url = url("pqrsasig/edit/$rec_id?$queryParams");
        ?>
        <div class="ajax-inline-page" data-url="{{ $url }}" >
            <div class="ajax-page-load-indicator">
                <div class="text-center d-flex justify-content-center load-indicator">
                    <span class="loader mr-3"></span>
                    <span class="fw-bold">Cargando...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade show " id="notpqrs_<?php echo $page_id ?>" role="tabpanel">
<div class=" ">
    <?php
        $params = ['id_sol_not' => $rec_id,'show_header' => false]; //new query param
        $query = array_merge(request()->query(), $params);
        $queryParams = http_build_query($query);
        $url = url("notpqrs/index/id_sol_not/$rec_id?$queryParams");
    ?>
    <div class="ajax-inline-page" data-url="{{ $url }}" >
        <div class="ajax-page-load-indicator">
            <div class="text-center d-flex justify-content-center load-indicator">
                <span class="loader mr-3"></span>
                <span class="fw-bold">Cargando...</span>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
