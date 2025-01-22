
	//check if current user role is allowed access to the pages
	$can_add = $user->canAccess("pqrsregpqrs/add");
	$can_edit = $user->canAccess("pqrsregpqrs/edit");
	$can_view = $user->canAccess("pqrsregpqrs/view");
	$can_delete = $user->canAccess("pqrsregpqrs/delete");

@section('content')
<?php
    $total_records = $records->total();
    if ($total_records) {
    foreach ($records as $data) {
    $rec_id = $data['id_sol'];
?>
<a href="<?php print_link("pqrsregpqrs/view/$rec_id"); ?>" class="search-link">
<div><?php echo $data['rad_sol'] ?></div>
<div><?php echo $data['nom_ent_sol'] ?></div>
<div><?php echo $data['nom_pet_sol'] ?></div>
<div><?php echo $data['email_sol'] ?></div>
</a>
<?php
    }
    } else {
?>
<div class="text-danger p-2 text-center ">
    ningún registro fue encontrado
</div>
<?php
    }
?>
@endsection
