<?php

namespace App\Exports;

use App\Souscripteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class NonSelectionneExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$souscripteurs=Souscripteur::with('localite.departement')
                                    ->Where("etat","non selectionné")
                                    ->get();
        return Souscripteur::all();
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
            'etat',
            'Localité',
            'Created at',
        ];
    }
}
