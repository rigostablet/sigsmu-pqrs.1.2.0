<?php 

namespace App\Exports;
use App\Models\PqrsRegPqrs;
use App\Models\PqrsPet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class PqrsregpqrsListPqrsTotalContExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(PqrsRegPqrs::exportListPqrsTotalContFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'radicado',
			'fecha sol',
			'fec resp',
			'respuesta',
			'nombre entid',
			'nombre pet',
			'medio solic',
			'descrip sol',
			'email_pet',
			'func notif',
			'dias resp',
			'dias pen',
			'estado pqrs',
			'usuario activo',
			'mun pet',
			'mun activo',
			'Date Created',
			'tipo petición',
			'munic petic',
			'oficina'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->rad_sol,
			$record->fec_sol,
			$record->fecrep_sol,
			$record->pqrsrespu_fec_respu,
			$record->nom_ent_sol,
			$record->nom_pet_sol,
			$record->medio_sol,
			$record->desc_sol,
			$record->pqrspet_email_pet,
			$record->id_asig_sol,
			$record->regsol_dias,
			$record->diaspen_sol,
			$record->regsol_est,
			$record->usu_sol,
			$record->mun_sol,
			$record->mun_user_sol,
			$record->date_created,
			$record->pqrstipsol_tipsol_nombre,
			$record->pqrsmun_nom_mun,
			$record->user_nom_ofic_user
        ];
    }
}
