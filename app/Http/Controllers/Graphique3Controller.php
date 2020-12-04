<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Khill\Lavacharts\Lavacharts;
use DB;
use App\Region;
use App\Province;
use App\Departement;
use App\Localite;
use App\Souscripteur;

class Graphique3Controller extends Controller
{
    protected $souscripteurs;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->souscripteurs = DB::table('souscripteurs')
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
    }

     /**
     * Execute the job.
     *
     * @return Lavacharts
     */
    public function graphe()
    {
            $nbHB=0;
            $nbCEN=0;
            $nbBM=0;
            $nbCAS=0;
            $nbCES=0;
            $nbCENOR=0;
            $nbCEOUE=0;
            $nbCESU=0;
            $nbEST=0;
            $nbNORD=0;
            $nbPC=0;
            $nbSAH=0;
            $nbSO=0;
            foreach ($this->souscripteurs as $souscripteur) {
                if ($souscripteur->libelleR=="HAUT BASSINS") {
                    $nbHB=$nbHB+1;
                }
                elseif ($souscripteur->libelleR=="CENTRE") {
                    $nbCEN=$nbCEN+1;
                }
                elseif ($souscripteur->libelleR=="BOUCLE DU MOUHOUN") {
                    $nbBM=$nbBM+1;
                }
                elseif ($souscripteur->libelleR=="CASCADE") {
                    $nbCAS=$nbCAS+1;
                }
                elseif ($souscripteur->libelleR=="CENTRE EST") {
                    $nbCES=$nbCES+1;
                }
                elseif ($souscripteur->libelleR=="CENTRE NORD") {
                    $nbCENOR=$nbCENOR+1;
                }
                elseif ($souscripteur->libelleR=="CENTRE OUEST") {
                    $nbCEOUE=$nbCEOUE+1;
                }
                elseif ($souscripteur->libelleR=="CENTRE SUD") {
                    $nbCESU=$nbCESU+1;
                }
                elseif ($souscripteur->libelleR=="EST") {
                    $nbEST=$nbEST+1;
                }
                elseif ($souscripteur->libelleR=="NORD") {
                    $nbNORD=$nbNORD+1;
                }
                elseif ($souscripteur->libelleR=="PLATEAU CENTRAL") {
                    $nbPC=$nbPC+1;
                }
                elseif ($souscripteur->libelleR=="SAHEL") {
                    $nbSAH=$nbSAH+1;
                }
                elseif ($souscripteur->libelleR=="SUD OUEST") {
                    $nbSO=$nbSO+1;
                }
            }
       $lava = new Lavacharts;
        $data = \Lava::DataTable();
        $data->addStringColumn('Mois')
                 ->addNumberColumn('CA');

        $data->addRow(['BOUCLE DU MOUHOUN',  $nbBM])
          ->addRow(['CASCADE', $nbCAS])
          ->addRow(['CENTRE',  $nbCEN])
          ->addRow(['CENTRE EST',  $nbCES])
          ->addRow(['CENTRE NORD',  $nbCENOR])
          ->addRow(['CENTRE OUEST', $nbCEOUE])
          ->addRow(['CENTRE SUD', $nbCESU])
          ->addRow(['EST', $nbEST])
          ->addRow(['HAUT BASSINS', $nbHB])
          ->addRow(['NORD', $nbNORD])
          ->addRow(['PLATEAU CENTRAL', $nbPC])
          ->addRow(['SAHEL', $nbSAH])
          ->addRow(['SUD OUEST', $nbSO]);
          \LAVA::PieChart('Graphique3', $data, [
            'largeur' =>400,
            'pieSliceText' =>'valeur'
        ]);
          return $lava;
    }
}
