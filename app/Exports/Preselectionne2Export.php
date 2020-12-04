<?php

namespace App\Exports;

use App\Souscripteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class Preselectionne2Export implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          $souscripteurs = DB::table('souscripteurs')
            ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                    'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                    'electricite','electronique','electrotechnique','climatisation','energie',
                    'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where("electricite",0)
            ->Where("electronique",0)
            ->Where("electrotechnique",0)
            ->Where("climatisation",0)
            ->Where("energie",0)
            ->take(3000)
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
            'Connaissance',
            'Profession',
            'Electricité',
            'Electronique',
            'Electrotechnique',
            'Froid climatisation',
            'Energie',
            'Localité',
            'operateur de saisie',
            'etat',
            'cnib',
            'diplome',
            'attestation',
            'autreDocument',
            'codeValidation',
            'numeroQuittance',
            'quittance',
            'attestation de formation',
            'Created at',
        ];
    }
}
