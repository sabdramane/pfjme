<?php

namespace App\Exports;

use App\Souscripteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class SelectionneExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          $souscripteurs = DB::table('souscripteurs')
            ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance','numCnib','dateEtabCnib','telephone','email','niveauEtude','profession',
                    'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
    	    ->Where("etat","non formé")
            ->Where("codeValidation","NULL")
            ->get();
        return $souscripteurs;
    }


     public function headings(): array
    {
        return [
            '#',
            'Code',
            'Nom',
            'Prénom',
            'Genre',
            'Lieu de Naissance',
            'Date naissance',
            'numero CNIB',
            'Date Etab CNIB',
            'Téléphone',
            'Email',
            'niveau étude',
            'Profession',
            'Région',
            'Province',
            'Departement',
            'Localité',
        ];
    }
}
