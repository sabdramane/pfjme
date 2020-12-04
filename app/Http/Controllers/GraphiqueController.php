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

class GraphiqueController extends Controller
{
    protected $souscripteurHB;
    protected $souscripteurBM;
    protected $souscripteurCAS;
    protected $souscripteurCEN;
    protected $souscripteurCES;
    protected $souscripteurCENOR;
    protected $souscripteurCEOUE;
    protected $souscripteurCESU;
    protected $souscripteurEST;
    protected $souscripteurNORD;
    protected $souscripteurPC;
    protected $souscripteurSAH;
    protected $souscripteurSO;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->souscripteurs=Souscripteur::with('localite.departement')
                                    ->Where("etat","préselectionné")
                                    ->take(2000)
                                    ->paginate(10);

        $this->souscripteurHB = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'HAUT BASSINS')
            ->get();
        $this->souscripteurBM = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'BOUCLE DU MOUHOUN')
            ->get();
        $this->souscripteurCAS = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CASCADE')
            ->get();
        $this->souscripteurCEN = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CENTRE')
            ->get();
        $this->souscripteurCES = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CENTRE EST')
            ->get();
        $this->souscripteurCENOR = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CENTRE NORD')
            ->get();
        $this->souscripteurCEOUE = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CENTRE OUEST')
            ->get();
        $this->souscripteurCESU = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'CENTRE SUD')
            ->get();
        $this->souscripteurEST = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'EST')
            ->get();
        $this->souscripteurNORD = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'NORD')
            ->get();
        $this->souscripteurPC = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'PLATEAU CENTRAL')
            ->get();
        $this->souscripteurSAH = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'SAHEL')
            ->get();
        $this->souscripteurSO = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.libelleR', '=', 'SUD OUEST')
            ->get();
    }

     /**
     * Execute the job.
     *
     * @return Lavacharts
     */
    public function graphe()
    {
        $nbHB=$this->souscripteurHB->count();
        $nbBM=$this->souscripteurBM->count();
        $nbCAS=$this->souscripteurCAS->count();
        $nbCEN=$this->souscripteurCEN->count();
        $nbCES=$this->souscripteurCES->count();
        $nbCENOR=$this->souscripteurCENOR->count();
        $nbCEOUE=$this->souscripteurCEOUE->count();
        $nbCESU=$this->souscripteurCESU->count();
        $nbEST=$this->souscripteurEST->count();
        $nbNORD=$this->souscripteurNORD->count();
        $nbPC=$this->souscripteurPC->count();
        $nbSAH=$this->souscripteurSAH->count();
        $nbSO=$this->souscripteurSO->count();

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
          \LAVA::PieChart('Graphique', $data, [
            'largeur' =>400,
            'pieSliceText' =>'valeur'
        ]);
          return $lava;
    }
}
