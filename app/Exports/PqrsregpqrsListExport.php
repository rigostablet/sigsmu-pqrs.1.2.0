<?php 

namespace App\Exports;
use App\Models\PqrsRegPqrs;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class PqrsregpqrsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(PqrsRegPqrs::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'rad',
			'fecSol',
			'fecResp',
			'Pqrstipsol Tipsol Nombre',
			'entidad solic',
			'nombre petic',
			'Medio Sol',
			'descripción',
			'email',
			'soporte',
			'mun pecti',
			'func notif',
			'dias asignados',
			'dias pend',
			'estado pqrs',
			'oficina',
			'mun activo',
			'usuario activo',
			'Date Created'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->rad_sol,
			$record->fec_sol,
			$record->fecrep_sol,
			$record->pqrstipsol_tipsol_nombre,
			$record->nom_ent_sol,
			$record->nom_pet_sol,
			$record->medio_sol,
			$record->desc_sol,
			$record->email_sol,
			$record->regsol_photo,
			$record->pqrsmun_nom_mun,
			$record->id_asig_sol,
			$record->regsol_dias,
			$record->diaspen_sol,
			$record->regsol_est,
			$record->user_nom_ofic_user,
			$record->mun_user_sol,
			$record->usu_sol,
			$record->date_created
        ];
    }
}
