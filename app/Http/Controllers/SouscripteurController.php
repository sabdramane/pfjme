<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\SouscripteurRequest;
use App\Http\Requests\PreModificationRequest;
use App\Http\Requests\EditionSouscripteurRequest;
use App\Http\Requests\VerificationSouscriptionRequest;
use App\Http\Requests\AttestationJoindreRequest;
use App\Http\Requests\ValidationSouscriptionRequest;
use App\Http\Controllers\GraphiqueController;
use App\Http\Controllers\Graphique2Controller;
use App\Http\Controllers\Graphique3Controller;
use App\Http\Controllers\SouscripteurController;
use Illuminate\Support\Facades\Storage;
use App\Region;
use App\Province;
use App\Departement;
use App\Localite;
use App\Souscripteur;
use App\Presouscripteur;
use App\User;
use App\Subvention;
use PDF;
use Excel;
use App\Exports\SouscripteursExport;
use App\Exports\Preselectionne1Export;
use App\Exports\Preselectionne2Export;
use App\Exports\SelectionneExport;
use App\Exports\NonSelectionneExport;
use Mail;
use Alert;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailSelectionJob;
use App\Sms\SendSMS;
use Khill\Lavacharts\Lavacharts;
use DB;
use Illuminate\Support\Facades\Crypt;

class SouscripteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Get region's province.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function provinces($id)
    {
        // Retour des provinces pour la région sélectionnée 
        return Province::whereRegionId($id)->get();
    }   

    /**
     * Get province's departement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function departements($id)
    {
        // Retour des departements pour la province sélectionnée 
        return Departement::whereProvinceId($id)->get();
    }   


    /**
     * Get region's province.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function localites($id)
    {
        // Retour des localites pour le departement sélectionnée 
        return Localite::whereDepartementId($id)->get();
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $regions= Region::all();

        if (auth()->check()) {
            if ((auth()->user()->role->abrege=='admin')||(auth()->user()->role->abrege=='recru')) {
                return view('erreur');
            }
            else
            {
                return view('souscription',compact('regions'));
            }

        }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SouscripteurRequest $request)
    {
        
        $id_souscripteur=0;

        $souscripteurs= Presouscripteur::all();
        if ($souscripteurs==null) {
            $id_souscripteur=0;
        }
        else
        {
            foreach ($souscripteurs as $souscripteu) {
                $id_souscripteur=$souscripteu->id;
            }
        }
        
        $id_souscripteur=$id_souscripteur+1;
    
        $id_souscripteur=0;

        $souscripteurs= Souscripteur::all();
        if ($souscripteurs==null) {
            $id_souscripteur=0;
        }
        else
        {
            foreach ($souscripteurs as $souscripteu) {
                $id_souscripteur=$souscripteu->id;
            }
        }
        
        $id_souscripteur=$id_souscripteur+1;
        
        $codeSecret=$id_souscripteur*2;
        $id="";
        if ($id_souscripteur<10) {
            $id="000".$id_souscripteur;
        }
        elseif ($id_souscripteur<100) {
            $id="00".$id_souscripteur;
        }
        elseif ($id_souscripteur<1000) {
            $id="0".$id_souscripteur;
        }
        else{
            $id="".$id_souscripteur;
        }

        $codeSouscription="ANEREE.".substr($request->nom, 0, 1)."".substr($request->prenom, 0, 1)."/".$id."/".$request->region.".".$request->province."/".$id_souscripteur."".$codeSecret;
        

        //Enregistrement du souscripteur
        $souscripteur= new Presouscripteur();
        $souscripteur->localite_id=$request->localite;
        $souscripteur->nom=$request->nom;
        $souscripteur->prenom=$request->prenom;
        $souscripteur->genre=$request->genre;
        $souscripteur->lieuNaissance=$request->lieuNaissance;
        $souscripteur->dateNaissance=$request->dateNaissance;
        $souscripteur->numCnib=$request->numCnib;
        $souscripteur->dateEtabCnib=$request->dateEtabCnib;
        $souscripteur->telephone=$request->telephone;
        $souscripteur->email=$request->email;
        $souscripteur->profession=$request->profession;
        
        if (!empty($_POST['connaissance'])) {
                foreach ($_POST['connaissance'] as $valeur) {
                    if (strcmp($valeur, "Electricité")==0) {
                        $souscripteur->electricite=true;
                    }
                    else if (strcmp($valeur, "Electronique")==0) {
                        $souscripteur->electronique=true;
                    }
                    else if (strcmp($valeur, "Electrotechnique")==0) {
                        $souscripteur->electrotechnique=true;
                    }
                    else if (strcmp($valeur, "Froid et climatisation")==0) {
                        $souscripteur->climatisation=true;
                    }
                    else if (strcmp($valeur, "Energie")==0) {
                        $souscripteur->energie=true;
                    }
                }
        }
        else
        {
            if (!empty($_POST['autre']))
            {
                $souscripteur->connaissance=$request->autreDomaine;
            }
            
        }
      /*  if (auth()->check()) {
            $souscripteur->user_id=auth()->user()->id;
        }*/
         $souscripteur->niveauEtude=$request->niveauEtude;
        
         if ($request->cnib != null) {
                $cnib="cnib".$id_souscripteur.".".$request->cnib->getClientOriginalExtension();
                $souscripteur->cnib=$cnib;
                $request->cnib->storeAs('uploads/cnib', ''.$cnib);

        }

         if ($request->diplome != null) {
                 $diplome="diplome".$id_souscripteur.".".$request->diplome->getClientOriginalExtension();
                $souscripteur->diplome=$diplome;
                $request->diplome->storeAs('uploads/diplome', ''.$diplome);
        }
         if ($request->attestation != null) {
                 $attestation="attestation".$id_souscripteur.".".$request->attestation->getClientOriginalExtension();
                $souscripteur->attestation=$attestation;
                $request->attestation->storeAs('uploads/attestation', ''.$attestation);
        }
       
         if ($request->autreDocument != null) {
                 $autreDocument="autreDocument".$id_souscripteur.".".$request->autreDocument->getClientOriginalExtension();
                $souscripteur->autreDocument=$autreDocument;
                $request->autreDocument->storeAs('uploads/autreDocument', ''.$autreDocument);
        }

        $souscripteur->save();

       $id_souscripteur=Crypt::encrypt($souscripteur->id);
       return redirect()->route('souscripteurs.validation',$id_souscripteur);
    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFormulaireValidation($id)
    {
         if (auth()->check()) {
            return view('formulaireValidationOperateur')->with('id',$id);
         }
         else
         {
            return view('formulaireValidation')->with('id',$id);
         }
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerSouscription(ValidationSouscriptionRequest $request)
    {
               $id=Crypt::decrypt($request->id);
                $presouscripteur=Presouscripteur::find($id);

                if ($presouscripteur==null) {
                  return view('erreur');
                }
                else
                {
						$id_souscripteur=0;

                            $souscripteurs= Souscripteur::all();
                            if ($souscripteurs==null) {
                                $id_souscripteur=0;
                            }
                            else
                            {
                                foreach ($souscripteurs as $souscripteu) {
                                    $id_souscripteur=$souscripteu->id;
                                }
                            }
                            
                            $id_souscripteur=$id_souscripteur+1;
                            
                            $codeSecret=$id_souscripteur*2;
                            $id="";
                            if ($id_souscripteur<10) {
                                $id="000".$id_souscripteur;
                            }
                            elseif ($id_souscripteur<100) {
                                $id="00".$id_souscripteur;
                            }
                            elseif ($id_souscripteur<1000) {
                                $id="0".$id_souscripteur;
                            }
                            else{
                                $id="".$id_souscripteur;
                            }
                            
                                $localite=Localite::with('departement.province')->find($presouscripteur->localite_id);

                                $codeSouscription="ANEREE.".substr($presouscripteur->nom, 0, 1)."".substr($presouscripteur->prenom, 0, 1)."/".$id."/".$localite->departement->province->region->id.".".$localite->departement->province->id."/".$id_souscripteur."".$codeSecret;

                                 //Enregistrement du souscripteur
                                $souscripteur= new Souscripteur();
                                $souscripteur->codeSouscripteur=$codeSouscription;
                                $souscripteur->localite_id=$presouscripteur->localite_id;
                                $souscripteur->nom=$presouscripteur->nom;
                                $souscripteur->prenom=$presouscripteur->prenom;
                                $souscripteur->genre=$presouscripteur->genre;
                                $souscripteur->lieuNaissance=$presouscripteur->lieuNaissance;
                                $souscripteur->dateNaissance=$presouscripteur->dateNaissance;
                                $souscripteur->numCnib=$presouscripteur->numCnib;
                                $souscripteur->dateEtabCnib=$presouscripteur->dateEtabCnib;
                                $souscripteur->telephone=$presouscripteur->telephone;
                                $souscripteur->email=$presouscripteur->email;
                                $souscripteur->profession=$presouscripteur->profession;
                                $souscripteur->niveauEtude=$presouscripteur->niveauEtude;
                                $souscripteur->electricite=$presouscripteur->electricite;
                                $souscripteur->electronique=$presouscripteur->electronique;
                                $souscripteur->electrotechnique=$presouscripteur->electrotechnique;
                                $souscripteur->climatisation=$presouscripteur->climatisation;
                                $souscripteur->energie=$presouscripteur->energie;
                                $souscripteur->connaissance=$presouscripteur->connaissance;
                                $souscripteur->cnib=$presouscripteur->cnib;
                                $souscripteur->diplome=$presouscripteur->diplome;
                                $souscripteur->attestation=$presouscripteur->attestation;
                                $souscripteur->autreDocument=$presouscripteur->autreDocument;
                                
       
                            $mobile=$request->mobile;
                            $codeOTP=$request->codeValidation;

                            $subvention= Subvention::whereNumerosubvention($codeOTP)->first();
					 if ($subvention==null) {
								$api="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
								<COMMAND>
								<TYPE>OMPREQ</TYPE>
								<customer_msisdn>".$mobile."</customer_msisdn>
								<merchant_msisdn>54093262</merchant_msisdn>
								<api_username>ANEREE</api_username>
								<api_password>Aneree@2019</api_password>
								<amount>20000</amount>
								<PROVIDER>101</PROVIDER>
								<PROVIDER2>101</PROVIDER2>
								<PAYID>12</PAYID>
								<PAYID2>12</PAYID2>
								<otp>".$codeOTP."</otp>
								<reference_number>789233</reference_number>
								<ext_txn_id>201500068544</ext_txn_id>
								</COMMAND>";

						 $url = 'https://apiom.orange.bf:9007/payment';
						 $ch = curl_init();
						 curl_setopt($ch, CURLOPT_URL, $url );
						 curl_setopt($ch, CURLOPT_POST, true );
						 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
						 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
						 curl_setopt($ch, CURLOPT_POSTFIELDS, $api);
						 $result = curl_exec($ch);
        
						if (stristr($result,'succes')==true) {
                                $souscripteur->codeValidation=$request->codeValidation;
								$souscripteur->save();
                        }
                        else
                        {
                              $id=$request->id;
							$erreur="Code OTP non valide";
						   return view('formulaireValidation',compact("id","erreur"));
							curl_close($ch);
                        }
					 }
                     else
                    {
                        $subventio= Souscripteur::whereSubvention($codeOTP)->first();
                        if ($subventio==null) {
                            $souscripteur->subvention=$request->codeValidation;
                            $souscripteur->save();
                        }
                        else
                        {
                             $id=$request->id;
                            $erreur="Code OTP non valide";
                           return view('formulaireValidation',compact("id","erreur"));
                        }
                    }
								$nom = $souscripteur->nom.' '.$souscripteur->prenom;
								$code =$souscripteur->codeSouscripteur;
								$email = $souscripteur->email;
								$tel = $souscripteur->telephone;
								if($email==null)
								{
									$email='dsi.energiebf@gmail.com';
								}
								$details['email'] = $email;
								$details['nom'] = $nom;
								$details['code'] = $code;
				//				SendEmailJob::dispatch($details);

                 $message = $nom.', ANEREE et Job Booster vous félicite pour votre inscription 
                 à la formation de 5000 jeunes.Votre code est: '.$code.' 
                 .Un mail vous a été envoyé.Veuillez garder ce code.'; /* your message */
                
                 $to = '226'.$tel; /* multiple receivers possible. example: '22671955166,22670163214' */
            /*
                $endpoint = "http://smsnanan.groupe-creativ.com/api.php";
                $keyword = 'ANEREE';
                $api_key = 'df066849-688b-426f-84a5-eb47a3f664ce';
                $params=[
                            'keyword'   => $keyword,
                            'api_key'   => $api_key,
                            'message'   => $message,
                            'to'        => $to,
                        ];

                /* make a POST request using curl */
            /*    $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $endpoint);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 
                     http_build_query($params));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec($ch);

                curl_close ($ch);
            */
                return redirect()->route('souscripteurs.notificationSave');
    }
    
         
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerSouscriptionOperateur(Request $request)
    {
        if (strcmp($request->methode, "methode1")==0) {
            return redirect()->route('souscripteurs.validerCode',$request->id);
        }
        elseif (strcmp($request->methode, "methode2")==0) {
            return redirect()->route('souscripteurs.validerQuittance',$request->id);
        }
        else
        {
           return redirect()->route('souscripteurs.validation',$request->id);
        }

    }
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerCode($id)
    {
        return view('formulaireValidationCode')->with('id',$id);

    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerQuittance($id)
    {
        return view('formulaireValidationQuittance')->with('id',$id);

    }
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerSouscriptionCode(ValidationSouscriptionRequest $request)
    {
        $id=Crypt::decrypt($request->id);
        $presouscripteur=Presouscripteur::find($id);

        if ($presouscripteur==null) {
            return view('erreur');
        }
        else
        {
            $id_souscripteur=0;

            $souscripteurs= Souscripteur::all();
            if ($souscripteurs==null) {
                    $id_souscripteur=0;
            }
            else
            {
                foreach ($souscripteurs as $souscripteu) {
                    $id_souscripteur=$souscripteu->id;
                }
            }
                    
            $id_souscripteur=$id_souscripteur+1;
            $codeSecret=$id_souscripteur*2;
            $id="";
            if ($id_souscripteur<10) {
                $id="000".$id_souscripteur;
             }
            elseif ($id_souscripteur<100) {
                   $id="00".$id_souscripteur;
            }
            elseif ($id_souscripteur<1000) {
                    $id="0".$id_souscripteur;
            }
            else{
                   $id="".$id_souscripteur;
            }

                        $localite=Localite::with('departement.province')->find($presouscripteur->localite_id);

                        $codeSouscription="ANEREE.".substr($presouscripteur->nom, 0, 1)."".substr($presouscripteur->prenom, 0, 1)."/".$id."/".$localite->departement->province->region->id.".".$localite->departement->province->id."/".$id_souscripteur."".$codeSecret;

                         //Enregistrement du souscripteur
                        $souscripteur= new Souscripteur();
                        $souscripteur->codeSouscripteur=$codeSouscription;
                        $souscripteur->localite_id=$presouscripteur->localite_id;
                        $souscripteur->nom=$presouscripteur->nom;
                        $souscripteur->prenom=$presouscripteur->prenom;
                        $souscripteur->genre=$presouscripteur->genre;
                        $souscripteur->lieuNaissance=$presouscripteur->lieuNaissance;
                        $souscripteur->dateNaissance=$presouscripteur->dateNaissance;
                        $souscripteur->numCnib=$presouscripteur->numCnib;
                        $souscripteur->dateEtabCnib=$presouscripteur->dateEtabCnib;
                        $souscripteur->telephone=$presouscripteur->telephone;
                        $souscripteur->email=$presouscripteur->email;
                        $souscripteur->profession=$presouscripteur->profession;
                        $souscripteur->niveauEtude=$presouscripteur->niveauEtude;
                        $souscripteur->electricite=$presouscripteur->electricite;
                        $souscripteur->electronique=$presouscripteur->electronique;
                        $souscripteur->electrotechnique=$presouscripteur->electrotechnique;
                        $souscripteur->climatisation=$presouscripteur->climatisation;
                        $souscripteur->energie=$presouscripteur->energie;
                        $souscripteur->connaissance=$presouscripteur->connaissance;
                        $souscripteur->cnib=$presouscripteur->cnib;
                        $souscripteur->diplome=$presouscripteur->diplome;
                        $souscripteur->attestation=$presouscripteur->attestation;
                        $souscripteur->autreDocument=$presouscripteur->autreDocument;
                        $souscripteur->user_id=auth()->user()->id;
						
						$mobile=$request->mobile;
                        $codeOTP=$request->codeValidation;
						$subvention= Subvention::whereNumerosubvention($codeOTP)->first();

                        if ($subvention==null) {
										$api="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
												<COMMAND>
												<TYPE>OMPREQ</TYPE>
												<customer_msisdn>".$mobile."</customer_msisdn>
												<merchant_msisdn>54093262</merchant_msisdn>
												<api_username>ANEREE</api_username>
												<api_password>Aneree@2019</api_password>
												<amount>20000</amount>
												<PROVIDER>101</PROVIDER>
												<PROVIDER2>101</PROVIDER2>
												<PAYID>12</PAYID>
												<PAYID2>12</PAYID2>
												<otp>".$codeOTP."</otp>
												<reference_number>789233</reference_number>
												<ext_txn_id>201500068544</ext_txn_id>
												</COMMAND>";

										 $url = 'https://apiom.orange.bf:9007/payment';
										 $ch = curl_init();
										 curl_setopt($ch, CURLOPT_URL, $url );
										 curl_setopt($ch, CURLOPT_POST, true );
										 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
										 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
										 curl_setopt($ch, CURLOPT_POSTFIELDS, $api);
										 $result = curl_exec($ch);
										 if (stristr($result,'succes')==true) {
											$souscripteur->codeValidation=$request->codeValidation;
										}
										else
										{
											$id=$request->id;
											$erreur="Code OTP non valide";
										   return view('formulaireValidationCode',compact("id","erreur"));
											curl_close($ch);
										}
						}
                        else
						{
                            $subventio= Souscripteur::whereSubvention($codeOTP)->first();
                            if ($subventio==null) {
                               $souscripteur->subvention=$request->codeValidation;
                            }
                            else
                            {
                                 $id=$request->id;
                                $erreur="Code OTP non valide";
                               return view('formulaireValidation',compact("id","erreur"));
                            }
                            
						}
           

						$souscripteur->save();
						$nom = $souscripteur->nom.' '.$souscripteur->prenom;
						$code =$souscripteur->codeSouscripteur;
						$email = $souscripteur->email;
						$tel = $souscripteur->telephone;
						if($email==null)
								{
									$email='dsi.energiebf@gmail.com';
								}
						$details['email'] = $email;
						$details['nom'] = $nom;
						$details['code'] = $code;
				/*		SendEmailJob::dispatch($details);

						$message = $nom.', ANEREE et Job Booster vous félicite pour votre inscription à la formation de 5000 jeunes.Votre code est: '.$code.'.Un mail vous a été envoyé.Veuillez garder ce code.'; /* your message */
						
				//		$to = '226'.$tel; /* multiple receivers possible. example: '22671955166,22670163214' */

				/*		$endpoint = "http://smsnanan.groupe-creativ.com/api.php";
						$keyword = 'ANEREE';
						$api_key = 'df066849-688b-426f-84a5-eb47a3f664ce';
						$params=[
									'keyword'   => $keyword,
									'api_key'   => $api_key,
									'message'   => $message,
									'to'        => $to,
								];

						/* make a POST request using curl */
				/*		$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, $endpoint);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, 
							 http_build_query($params));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

						$server_output = curl_exec($ch);

						curl_close ($ch);
				*/
                		return redirect()->route('souscripteurs.notificationSave');
            
        }
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validerSouscriptionQuittance(ValidationSouscriptionRequest $request)
    {
        $id=Crypt::decrypt($request->id);
        $presouscripteur=Presouscripteur::find($id);

        if ($presouscripteur==null) {
            return view('erreur');
        }
        else
        {
            $id_souscripteur=0;

            $souscripteurs= Souscripteur::all();
            if ($souscripteurs==null) {
                    $id_souscripteur=0;
            }
            else
            {
                foreach ($souscripteurs as $souscripteu) {
                    $id_souscripteur=$souscripteu->id;
                }
            }
                    
            $id_souscripteur=$id_souscripteur+1;
            $codeSecret=$id_souscripteur*2;
            $id="";
            if ($id_souscripteur<10) {
                $id="000".$id_souscripteur;
             }
            elseif ($id_souscripteur<100) {
                   $id="00".$id_souscripteur;
            }
            elseif ($id_souscripteur<1000) {
                    $id="0".$id_souscripteur;
            }
            else{
                   $id="".$id_souscripteur;
            }

                        $localite=Localite::with('departement.province')->find($presouscripteur->localite_id);

                        $codeSouscription="ANEREE.".substr($presouscripteur->nom, 0, 1)."".substr($presouscripteur->prenom, 0, 1)."/".$id."/".$localite->departement->province->region->id.".".$localite->departement->province->id."/".$id_souscripteur."".$codeSecret;

                         //Enregistrement du souscripteur
                        $souscripteur= new Souscripteur();
                        $souscripteur->codeSouscripteur=$codeSouscription;
                        $souscripteur->localite_id=$presouscripteur->localite_id;
                        $souscripteur->nom=$presouscripteur->nom;
                        $souscripteur->prenom=$presouscripteur->prenom;
                        $souscripteur->genre=$presouscripteur->genre;
                        $souscripteur->lieuNaissance=$presouscripteur->lieuNaissance;
                        $souscripteur->dateNaissance=$presouscripteur->dateNaissance;
                        $souscripteur->numCnib=$presouscripteur->numCnib;
                        $souscripteur->dateEtabCnib=$presouscripteur->dateEtabCnib;
                        $souscripteur->telephone=$presouscripteur->telephone;
                        $souscripteur->email=$presouscripteur->email;
                        $souscripteur->profession=$presouscripteur->profession;
                        $souscripteur->niveauEtude=$presouscripteur->niveauEtude;
                        $souscripteur->electricite=$presouscripteur->electricite;
                        $souscripteur->electronique=$presouscripteur->electronique;
                        $souscripteur->electrotechnique=$presouscripteur->electrotechnique;
                        $souscripteur->climatisation=$presouscripteur->climatisation;
                        $souscripteur->energie=$presouscripteur->energie;
                        $souscripteur->connaissance=$presouscripteur->connaissance;
                        $souscripteur->cnib=$presouscripteur->cnib;
                        $souscripteur->diplome=$presouscripteur->diplome;
                        $souscripteur->attestation=$presouscripteur->attestation;
                        $souscripteur->autreDocument=$presouscripteur->autreDocument;
                        $souscripteur->user_id=auth()->user()->id;

                $souscripteur->numeroQuittance=$request->numeroQuittance;
                if ($request->quittance != null) {
                    $quittance="quittance".$id_souscripteur.".".$request->quittance->getClientOriginalExtension();
                    $souscripteur->quittance=$quittance;
                    $request->quittance->storeAs('uploads/quittance', ''.$quittance);
                }
            $souscripteur->save();
            $nom = $souscripteur->nom.' '.$souscripteur->prenom;
            $code =$souscripteur->codeSouscripteur;
            $email = $souscripteur->email;
            $tel = $souscripteur->telephone;
            if($email==null)
					{
						$email='dsi.energiebf@gmail.com';
					}
            $details['email'] = $email;
            $details['nom'] = $nom;
            $details['code'] = $code;
      /*      SendEmailJob::dispatch($details);

            $message = $nom.', ANEREE et Job Booster vous félicite pour votre inscription à la formation de 5000 jeunes.Votre code est: '.$code.'.Un mail vous a été envoyé.Veuillez garder ce code.'; /* your message */
            
        //    $to = '226'.$tel; /* multiple receivers possible. example: '22671955166,22670163214' */

          /*  $endpoint = "http://smsnanan.groupe-creativ.com/api.php";
            $keyword = 'ANEREE';
            $api_key = 'df066849-688b-426f-84a5-eb47a3f664ce';
            $params=[
                        'keyword'   => $keyword,
                        'api_key'   => $api_key,
                        'message'   => $message,
                        'to'        => $to,
                    ];

            /* make a POST request using curl */
            /*$ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                 http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);
            */
            return redirect()->route('souscripteurs.notificationSave');
           
        }
    }

    /**
     * prémodification.
     *
     * @return \Illuminate\Http\Response
     */
    public function notificationSave()
    {
        return view('notificationSave');
    }

    /**
     * prémodification.
     *
     * @return \Illuminate\Http\Response
     */
    public function preEdite()
    {
        return view('preModification');
    }

    /**
     * edition et renvoie de formulaire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edition(PreModificationRequest $request)
    {
        $souscripteur=Souscripteur::whereCodesouscripteur($request->codeSouscripteur)->whereNumcnib($request->numCnib)->first();
       

        if ($souscripteur==null) {
            return view('preModification')->with('erreur','erreur');
        }
        else
        {
            $id_souscripteur=Crypt::encrypt($souscripteur->id);
            return redirect()->route('souscripteurs.editionSouscription',$id_souscripteur);
        }
        
    }

    /**
     * prémodification.
     *
     * @return \Illuminate\Http\Response
     */
    public function editionSouscription($id)
    {
        $id=Crypt::decrypt($id);
        $souscripteur=Souscripteur::find($id);

        if ($souscripteur==null) {
            return view('erreur');
        }
        else
        {
            $localite=Localite::with('departement.province')->find($souscripteur->localite_id);
            $regions=Region::all();
            return view('editSouscription',  compact('souscripteur','localite','regions'));
        }
    }


    /**
     * edition et renvoie de formulaire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modification($id)
    {
        $id=Crypt::decrypt($id);
        $souscripteur=Souscripteur::find($id);
        if ($souscripteur==null) {
           return view('erreur');
        }
        else
        {
            $localite=Localite::with('departement.province')->find($souscripteur->localite_id);
            
            $regions=Region::all();

            return view('editSouscription',  compact('souscripteur','localite','regions'));
        
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditionSouscripteurRequest $request, Souscripteur $souscripteur)
    {
        
            if ($request->cni != null) {
                $cni="cnib".$souscripteur->id.".".$request->cni->getClientOriginalExtension();
                $souscripteur->cnib=$cni;
                $request->cni->storeAs('uploads/cnib', ''.$cni);

            }

            if ($request->diplom != null) {
                 $diplome="diplome".$souscripteur->id.".".$request->diplom->getClientOriginalExtension();
                $souscripteur->diplome=$diplome;
                $request->diplom->storeAs('uploads/diplome', ''.$diplome);
            }
        
             if ($request->attestatio != null) {
                 $attestation="attestation".$souscripteur->id.".".$request->attestatio->getClientOriginalExtension();
                $souscripteur->attestation=$attestation;
                $request->attestatio->storeAs('uploads/attestation', ''.$attestation);
            }
            if ($request->autreDocumen != null) {
                 $autreDocument="autreDocument".$souscripteur->id.".".$request->autreDocumen->getClientOriginalExtension();
                $souscripteur->autreDocument=$autreDocument;
                $request->autreDocumen->storeAs('uploads/autreDocument', ''.$autreDocument);
            }
  
        $souscripteur->localite_id=$request->localite;
        $souscripteur->nom=$request->nom;
        $souscripteur->prenom=$request->prenom;
        $souscripteur->genre=$request->genre;
        $souscripteur->lieuNaissance=$request->lieuNaissance;
        $souscripteur->dateNaissance=$request->dateNaissance;
        $souscripteur->numCnib=$request->numCnib;
        $souscripteur->dateEtabCnib=$request->dateEtabCnib;
        $souscripteur->telephone=$request->telephone;
        $souscripteur->email=$request->email;
        $souscripteur->profession=$request->profession;

        if (!empty($_POST['connaissance'])) {
         foreach ($_POST['connaissance'] as $valeur) {
            if (strcmp($valeur, "Electricité")==0) {
                $souscripteur->electricite=true;
            }
            else if (strcmp($valeur, "Electronique")==0) {
                $souscripteur->electronique=true;
            }
            else if (strcmp($valeur, "Electrotechnique")==0) {
                $souscripteur->electrotechnique=true;
            }
            else if (strcmp($valeur, "Froid et climatisation")==0) {
                $souscripteur->climatisation=true;
            }
            else if (strcmp($valeur, "Energie")==0) {
                $souscripteur->energie=true;
            }
            
        }
        }
        else
        {
            if (!empty($_POST['autre']))
            {
                $souscripteur->connaissance=$request->autreDomaine;
                $souscripteur->energie=false;
                $souscripteur->climatisation=false;
                $souscripteur->electrotechnique=false;
                $souscripteur->electronique=false;
                $souscripteur->electricite=false;
            }
            
        }

        $souscripteur->niveauEtude=$request->niveauEtude;

        $souscripteur->save();
       
       return redirect()->route('souscripteurs.notifEdit');

    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifieEdit()
    {
         return view('notificationEdit');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifierSouscription()
    {
        return view('verifierSouscription');
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verification(VerificationSouscriptionRequest $request)
    {
         $souscripteur=Souscripteur::whereNumcnib($request->numCnib)->first();
        
        if ($souscripteur==null) {
           return view('verification')->with('message','Ce numéro CNIB n\'est pas encore inscrit');
        }
        else
        {
            $nom=$souscripteur->nom." ".$souscripteur->prenom;
            $message=$nom." est inscrit!";
            return view('verification')->with('message',$message);
        }
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        if (auth()->check()) {
                $souscripteurs=Souscripteur::paginate(10);

             $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();

                $graphique=new GraphiqueController;
                $graphique2=new Graphique2Controller;
                $graphique3=new Graphique3Controller;
               
                $lava = new Lavacharts;
                $lava2 = new Lavacharts;
                $lava3 = new Lavacharts;
                $lava=$graphique->graphe();
                $lava2=$graphique2->graphe();
                $lava3=$graphique3->graphe();
                return view('listeSouscripteurs',compact('souscripteurs','lava','lava2','lava3','nbTotal','nb1','nb2'));
         }
        else
        {
            return view('erreur');
        }
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeSouscripteurOpera($id)
    {
        if (auth()->check()) {
                $souscripteurs=Souscripteur::with('localite.departement')
                                            ->with('user')
                                            ->Where("user_id",$id)
                                            ->get();
                return $souscripteurs;
        }
        else
        {
            return view('erreur');
        }
    }

       /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operaListeSouscripteur()
    {
        if (auth()->check()) {
                $souscripteurs=Souscripteur::with('localite.departement')
                                             ->with('user')
                                            ->Where("user_id","!=",null)
                                            ->paginate(10);
                
                $users=User::with('role')->Where('role_id',4)
                                         ->orWhere('role_id',5)
                                         ->get();

                $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();


                 $graphique=new GraphiqueController;
                $graphique2=new Graphique2Controller;
                $graphique3=new Graphique3Controller;
               
                $lava = new Lavacharts;
                $lava2 = new Lavacharts;
                $lava3 = new Lavacharts;
                $lava=$graphique->graphe();
                $lava2=$graphique2->graphe();
                $lava3=$graphique3->graphe();
                return view('listeSouscripteursOperateur',compact('souscripteurs','lava','lava2','lava3','users','nbTotal','nb1','nb2'));
         }
        else
        {
            return view('erreur');
        }
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeVague1()
    {
        if (auth()->check()) {
            $souscripteurs=Souscripteur::with('localite.departement')
                                        ->orWhere("electricite",1)
                                        ->orWhere("electronique",1)
                                        ->orWhere("electrotechnique",1)
                                        ->orWhere("climatisation",1)
                                        ->orWhere("energie",1)
                                        ->get();
            
		$nbSouscripteur=0;
		foreach($souscripteurs as $souscripteur)
		{
			$nbSouscripteur=$nbSouscripteur+1;
		}

        $souscripteurs=Souscripteur::with('localite.departement')
                                        ->Where("etat","non formé")
                                        ->Where(function($query)
                                            {
                                               $query->Where("electricite",1)
                                                ->orWhere("electronique",1)
                                                ->orWhere("electrotechnique",1)
                                                ->orWhere("climatisation",1)
                                                ->orWhere("energie",1);
                                            })
                                        ->take(2000)
                                        ->paginate(10);

        $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();

				$graphique=new GraphiqueController;
                $graphique2=new Graphique2Controller;
                $graphique3=new Graphique3Controller;
               
                $lava = new Lavacharts;
                $lava2 = new Lavacharts;
                $lava3 = new Lavacharts;
                $lava=$graphique->graphe();
                $lava2=$graphique2->graphe();
                $lava3=$graphique3->graphe();
           
            return view('listeSouscripteursVague1',compact('souscripteurs','lava','lava2','lava3','nbSouscripteur','nbTotal','nb1','nb2'));
        }
        else
        {
            return view('erreur');
        }
       
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeVague2()
    {
        if (auth()->check()) {
            $souscripteurs=Souscripteur::with('localite.departement')
                                        ->Where("etat","non formé")
                                        ->Where("electricite",0)
                                        ->Where("electronique",0)
                                        ->Where("electrotechnique",0)
                                        ->Where("climatisation",0)
                                        ->Where("energie",0)
                                        ->get();

            $nbSouscripteur=0;
            foreach($souscripteurs as $souscripteur)
            {
                $nbSouscripteur=$nbSouscripteur+1;
            }

            $souscripteurs=Souscripteur::with('localite.departement')
                                        ->Where("etat","non formé")
                                        ->Where("electricite",0)
                                        ->Where("electronique",0)
                                        ->Where("electrotechnique",0)
                                        ->Where("climatisation",0)
                                        ->Where("energie",0)
                                        ->take(3000)
                                        ->paginate(10);

            $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();

            $graphique=new GraphiqueController;
                $graphique2=new Graphique2Controller;
                $graphique3=new Graphique3Controller;
               
                $lava = new Lavacharts;
                $lava2 = new Lavacharts;
                $lava3 = new Lavacharts;
                $lava=$graphique->graphe();
                $lava2=$graphique2->graphe();
                $lava3=$graphique3->graphe();
            return view('listeSouscripteursVague2',compact('souscripteurs','lava','lava2','lava3','nbSouscripteur','nbTotal','nb1','nb2'));
        }
        else
        {
            return view('erreur');
        }
    }
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operateurListe()
    {
        if (auth()->check()) {

            $id=auth()->user()->id;
            $souscripteurs=Souscripteur::Where("user_id",$id)
                                    ->paginate(10);
            return view('listeOperateurSouscripteur',compact('souscripteurs'));
        }
        else
        {
            return view('erreur');
        }
        
    }
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeSelectionne()
    {
        if (auth()->check()) {

             $souscripteurs=Souscripteur::Where("etat","formé")
                                    ->take(5000)
                                    ->paginate(10);

            $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();

            $graphique=new GraphiqueController;
            $graphique2=new Graphique2Controller;
            $graphique3=new Graphique3Controller;
               
            $lava = new Lavacharts;
            $lava2 = new Lavacharts;
            $lava3 = new Lavacharts;
            $lava=$graphique->graphe();
            $lava2=$graphique2->graphe();
            $lava3=$graphique3->graphe();

            return view('listeSouscripteursSelectionne',compact('souscripteurs','lava','lava2','lava3','nbTotal','nb1','nb2'));
        }
        else
        {
            return view('erreur');
        }
       
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeNonSelectionne()
    {
        if (auth()->check()) {
            $souscripteurs=Souscripteur::Where("etat","non selectionné")
                                        ->paginate(10);

            $souscripteursAl=Souscripteur::all();

                $souscripteurs1 = DB::table('souscripteurs')
                                ->select('souscripteurs.id','codeSouscripteur','nom','prenom','genre','lieuNaissance','dateNaissance',
                                        'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
                                        'electricite','electronique','electrotechnique','climatisation','energie',
                                        'regions.libelleR','provinces.libelleP','departements.libelleD','localites.libelleL')
                                ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
                                ->join('departements', 'departements.id', '=', 'localites.departement_id')
                                ->join('provinces', 'provinces.id', '=', 'departements.province_id')
                                ->join('regions', 'regions.id', '=', 'provinces.region_id')
                                ->orWhere("electricite",1)
                                ->orWhere("electronique",1)
                                ->orWhere("electrotechnique",1)
                                ->orWhere("climatisation",1)
                                ->orWhere("energie",1)
                                ->get();
                $souscripteurs2 = DB::table('souscripteurs')
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
                                ->get();
                $nbTotal=$souscripteursAl->count();
                $nb1=$souscripteurs1->count();
                $nb2=$souscripteurs2->count();
                
            $graphique=new GraphiqueController;
            $graphique2=new Graphique2Controller;
            $graphique3=new Graphique3Controller;
               
            $lava = new Lavacharts;
            $lava2 = new Lavacharts;
            $lava3 = new Lavacharts;
            $lava=$graphique->graphe();
            $lava2=$graphique2->graphe();
            $lava3=$graphique3->graphe();

            return view('listeSouscripteursNonSelectionne',compact('souscripteurs','lava','lava2','lava3','nbTotal','nb1','nb2'));
            
         }
        else
        {
            return view('erreur');
        }
    }
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selection($id)
    {
        if (auth()->check()) {
            //$id=Crypt::decrypt($id);
            $souscripteur=Souscripteur::find($id);
            $souscripteur->etat="formé";
            $souscripteur->save();
            return redirect()->route('souscripteurs.listeVague1');
        }
        else
        {
            return view('erreur');
        }
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selection1($id)
    {
        if (auth()->check()) {
          //  $id=Crypt::decrypt($id);
            $souscripteur=Souscripteur::find($id);
            $souscripteur->etat="formé";
            $souscripteur->save();
            return redirect()->route('souscripteurs.listeVague1');
        }
        else
        {
            return view('erreur');
        }
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selection2($id)
    {
        if (auth()->check()) {
           //$id=Crypt::decrypt($id);
            $souscripteur=Souscripteur::find($id);
            $souscripteur->etat="formé";
            $souscripteur->save();
            return redirect()->route('souscripteurs.listeVague2');
        }
        else
        {
            return view('erreur');
        }
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function joindreAttestation($id)
    {
        if (auth()->check()) {
           return view('joindreAttestation')->with('id',$id);
        }
        else
        {
            return view('erreur');
        }
    }

       /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attestationJoint(AttestationJoindreRequest $request)
    {
        if (auth()->check()) {

            $id=Crypt::decrypt($request->id);
            $souscripteur=Souscripteur::find($id);

             if ($request->attestation != null) {
                 $attestation="attestationformation".$souscripteur->id.".".$request->attestation->getClientOriginalExtension();
                $souscripteur->attestationFormation=$attestation;
                $request->attestation->storeAs('uploads/formation', ''.$attestation);
            }
            $souscripteur->save();
           return redirect()->route('souscripteurs.listeVague1');
        }
        else
        {
            return view('erreur');
        }
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nonSelection($id)
    {
        if (auth()->check()) {
                $souscripteur=Souscripteur::find($id);
                $souscripteur->etat="non selectionné";
                $souscripteur->save();
              
                return response()->json([
                            'success' => 'Record deleted successfully!'
                        ]);
        }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererPDF()
    {
        if (auth()->check()) {
            $souscripteurs=Souscripteur::paginate(200);
            $idLast=0;
            $idFirst=$idLast+1;
            foreach ($souscripteurs as $souscripteurs) {
                $idLast=$souscripteurs->id;
            }
            $souscripteurs=Souscripteur::paginate(200);
           /*     
                */
                //return $idLast;
                return view('generationPDF',compact('souscripteurs','idLast','idFirst'));
        }
        else
        {
            return view('erreur');
        }
    }
    /**
         * Display the specified resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function genererListePDF($idMin,$idMax,$numPage)
        {
            $souscripteurs=Souscripteur::Where("id",">=",$idMin)
                                        ->Where("id","<=",$idMax)
                                        ->get();
            $titre="Liste des souscripteurs N° ".$numPage;
            $nom="listeSouscripteur_".$numPage;
                
            $pdf=PDF::loadView('listeSouscripteursPDF',compact('souscripteurs','titre'));
                
            return $pdf->download($nom);
        }

    /**
         * Display the specified resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function genererListeExcel($idMin,$idMax,$numPage)
        {
            $nom="souscripteurs_".$numPage.".xlsx";
            return Excel::download(new SouscripteursExport($idMin,$idMax), $nom);
        }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererMesListePDF()
    {
         if (auth()->check()) {
            $id=auth()->user()->id;
            $nomUtilisateur=auth()->user()->username;
            $souscripteurs=Souscripteur::Where("user_id",$id)
                                        ->get();

            $titre="Liste des souscripteurs de ".$nomUtilisateur;
            $nom="listeSouscripteur";
            
            $pdf=PDF::loadView('listeSouscripteursPDF',compact('souscripteurs','titre'));
            
            return $pdf->download($nom);
        }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererExcel()
    {
         if (auth()->check()) {
                return Excel::download(new SouscripteursExport, 'souscripteurs.xlsx');
         }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererPreselectionnePDF()
    {
        if (auth()->check()) {
                 $souscripteurs=Souscripteur::with('localite.departement')
                                        ->orWhere("electricite",1)
                                        ->orWhere("electronique",1)
                                        ->orWhere("electrotechnique",1)
                                        ->orWhere("climatisation",1)
                                        ->orWhere("energie",1)
                                        ->take(2000)
                                    ->get();
                $titre="Liste des souscripteurs 1ère catégorie";
                 $nom="liste_souscripteur_preselectionne";
                $pdf=PDF::loadView('listeSouscripteursPDF',compact('souscripteurs','titre'));
                 return $pdf->download($nom);

         }
        else
        {
            return view('erreur');
        }
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererPreselectionneExcel()
    {
        if (auth()->check()) {
                return Excel::download(new Preselectionne1Export, 'souscripteurs.xlsx');
        }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererPreselectionne2PDF()
    {
        if (auth()->check()) {
                $souscripteurs=Souscripteur::with('localite.departement')
                                        ->Where("electricite",0)
                                        ->Where("electronique",0)
                                        ->Where("electrotechnique",0)
                                        ->Where("climatisation",0)
                                        ->Where("energie",0)
                                        ->take(3000)
                                    ->get();
                $titre="Liste des souscripteurs 2ème catégorie";
                 $nom="liste_souscripteur_preselectionne";
                $pdf=PDF::loadView('listeSouscripteursPDF',compact('souscripteurs','titre'));
                 return $pdf->download($nom);
         }
        else
        {
            return view('erreur');
        }
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererPreselectionne2Excel()
    {
        if (auth()->check()) {
            return Excel::download(new Preselectionne2Export, 'souscripteurs.xlsx');
        }
        else
        {
            return view('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererSelectionnePDF()
    {
         if (auth()->check()) {
            $souscripteurs=Souscripteur::Where("etat","formé")
                                    ->paginate(200);
            return view('generationSelectionneePDF',compact('souscripteurs'));
        }
        else
        {
            return view('erreur');
        }
    }

    /**
         * Display the specified resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function genererListeSelectionneePDF($idMin,$idMax,$numPage)
        {
            $souscripteurs=Souscripteur::Where("etat","formé")
                                        ->Where("id",">=",$idMin)
                                        ->Where("id","<=",$idMax)
                                        ->get();
            $titre="Liste des souscripteurs formés N° ".$numPage;
            $nom="listeSouscripteurFormés_".$numPage;
                
            $pdf=PDF::loadView('listeSouscripteursPDF',compact('souscripteurs','titre'));
                
            return $pdf->download($nom);
        }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererSelectionneExcel()
    {
        if (auth()->check()) {
            return Excel::download(new SelectionneExport, 'souscripteurs.xlsx');
        }
        else
        {
            return view('erreur');
        }
    }
   
     /**
     * prémodification.
     *
     * @return \Illuminate\Http\Response
     */
    public function preSuivie()
    {
        return view('preDossier');
    }

     /**
     * suivie dossier.
     *
     * @return \Illuminate\Http\Response
     */
    public function suivieDossier(PreModificationRequest $request)
    {
        $souscripteur=Souscripteur::whereCodesouscripteur($request->codeSouscripteur)->whereNumcnib($request->numCnib)->first();
       

        if ($souscripteur==null) {
            return view('preDossier')->with('erreur','erreur');
        }
        else
        {
            return view('dossier',compact('souscripteur'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function formationJeune()
    {
        Alert::message('Welcome back!');

        return view('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscriptionAide()
    {
       return view('aide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($nom)
    {
       if (!auth()->check()) {
             return view('erreur');
        }
        if (strstr($nom,"cnib")) {
            return response()->download(storage_path('app/public/uploads/cnib/'.$nom));
        }
        elseif (strstr($nom, "diplome")) {
            return response()->download(storage_path('app/public/uploads/diplome/'.$nom));
        }
        elseif (strstr($nom,"attestation")) {
            return response()->download(storage_path('app/public/uploads/attestation/'.$nom));
        }
        elseif (strstr($nom,"autreDocument")) {
            return response()->download(storage_path('app/public/uploads/autreDocument/'.$nom));
        }
        
       // return response()->download(storage_path('app/public/uploads/cnib/'.$nom));
    }
     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadAttestation($nom)
    {
        if (strstr($nom,"attestationformation")) {
            return response()->download(storage_path('app/public/uploads/formation/'.$nom));
        }
       // return response()->download(storage_path('app/public/uploads/cnib/'.$nom));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function recruteurLogin()
    {
       return view('recruteurLogin');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function recruteurAccueil()
    {
        $regions= Region::all();
        $provinces= Province::all();

       return view('recruteurAccueil',compact('regions','provinces'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursRegion($id)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->join('regions', 'regions.id', '=', 'provinces.region_id')
            ->Where('regions.id', '=', $id)
            ->get();
        return $souscripteurs;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursProvince($id)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->join('localites', 'souscripteurs.localite_id', '=', 'localites.id')
            ->join('departements', 'departements.id', '=', 'localites.departement_id')
            ->join('provinces', 'provinces.id', '=', 'departements.province_id')
            ->Where('provinces.id', '=', $id)
            ->get();
        return $souscripteurs;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursNom($nom_Id)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom_Id)
            ->Where('etat', '=', "non formé")
            ->get();
        return $souscripteurs;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursPrenom($nom,$prenom)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom)
            ->Where('prenom', '=', $prenom)
            ->Where('etat', '=', "non formé")
            ->get();
        return $souscripteurs;
    }

      /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function rechercher()
    {
        $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', "inconnu")
            ->get();
        return view('accueilRecherche',compact('souscripteurs'));
    }
      /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function recherche(Request $request)
    {
        $nom=$request->nom;
        $prenom=$request->prenom;
        $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', "inconnu")
            ->get();

        if ((strcmp($nom, "")==0)&&(strcmp($prenom, "")==0)) {
             return redirect()->route('rechercher');
        }
        elseif(strcmp($nom, "")==0) {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('prenom', '=', $prenom)
            ->Where('etat', '=', "non formé")
            ->get();
        }
        elseif(strcmp($prenom, "")==0) {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom)
            ->Where('etat', '=', "non formé")
            ->get();
        }
        else
        {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom)
            ->Where('prenom', '=', $prenom)
            ->Where('etat', '=', "non formé")
            ->get();
        }
        return view('accueilRecherche',compact('souscripteurs'));
        
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rechercheSelection($id)
    {
        if (auth()->check()) {
          //  $id=Crypt::decrypt($id);
            $souscripteur=Souscripteur::find($id);
            $souscripteur->etat="formé";
            $souscripteur->save();
            return redirect()->route('rechercher');
        }
        else
        {
            return view('erreur');
        }
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursFormeNom($nom_Id)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom_Id)
            ->Where('etat', '=', "formé")
            ->get();
        return $souscripteurs;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function souscripteursFormePrenom($nom,$prenom)
    {

       $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', $nom)
            ->Where('prenom', '=', $prenom)
            ->Where('etat', '=', "formé")
            ->get();
        return $souscripteurs;
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nonForme($id)
    {
        if (auth()->check()) {
            //$id=Crypt::decrypt($id);
            $souscripteur=Souscripteur::find($id);
            $souscripteur->etat="non formé";
            $souscripteur->save();
            return redirect()->route('souscripteurs.listeSelectionne');
        }
        else
        {
            return view('erreur');
        }
    }


      /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function rechercheAvancee()
    {
        $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', "inconnu")
            ->get();
            $nb=0;
            $nom="";
        return view('accueilRechercheAvancee',compact('souscripteurs','nb','nom'));
    }

      /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function rechercheAvance(Request $request)
    {
        $filtre=$request->filtre;
        
        $nb=0;

        $souscripteurs = DB::table('souscripteurs')
            ->Where('nom', '=', "inconnu")
            ->get();
        $nom="";
        if (strcmp($filtre, "")==0) {
             return redirect()->route('rechercheAvancee');
        }
        elseif(strcmp($filtre, "CodeOTP")==0) {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('codeValidation', '!=', NULL)
            ->get();
            $nb=$souscripteurs->count();
            $nom="CodeOTP";
        }
        elseif(strcmp($filtre, "quittance")==0) {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('numeroQuittance', '!=',NULL)
            ->get();
            $nb=$souscripteurs->count();
            $nom="quittance";
        }
        else
        {
            $souscripteurs = DB::table('souscripteurs')
            ->Where('subvention', '!=', NULL)
            ->get();
            $nb=$souscripteurs->count();
            $nom="subvention";
        }

        /*
        $titre="Liste des souscripteurs orange money";
        $nom="listeSouscripteur";
                
        $pdf=PDF::loadView('listeSouscripteursPDFOTP',compact('souscripteurs','titre','nb'));
               
                return $pdf->download($nom); */
        return view('accueilRechercheAvancee',compact('souscripteurs','nb','nom'));
        
    }

      /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadListeSouscripteur($nom)
    {
        if (auth()->check()) {

            $nb=0;

            $souscripteurs = DB::table('souscripteurs')
                ->Where('nom', '=', "inconnu")
                ->get();

                    if (strcmp($nom, "")==0) {
                     return redirect()->route('rechercheAvancee');
                }
                elseif(strcmp($nom, "CodeOTP")==0) {
                    $souscripteurs = DB::table('souscripteurs')
                    ->Where('codeValidation', '!=', NULL)
                    ->get();
                    $nb=$souscripteurs->count();
                }
                elseif(strcmp($nom, "quittance")==0) {
                    $souscripteurs = DB::table('souscripteurs')
                    ->Where('numeroQuittance', '!=',NULL)
                    ->get();
                    $nb=$souscripteurs->count();
                }
                else
                {
                    $souscripteurs = DB::table('souscripteurs')
                    ->Where('subvention', '!=', NULL)
                    ->paginate(1000);
                    $nb=$souscripteurs->count();
                }

            $titre="Liste des souscripteurs en fonction de".$nom;
            $fiche="listeSouscripteur";
                
          //  $pdf=PDF::loadView('listeSouscripteursPDFOTP',compact('souscripteurs','titre','nb'));
            $pdf = PDF::loadView('listeSouscripteursPDFOTP',compact('souscripteurs'));

            return $pdf->download('listesous.pdf');
            //return PDF::loadView()->save(public_path().'/pdfs/'.$fiche.'.pdf')->stream();
               
                //return $pdf->stream(); 
        }
        else
        {
            return view('erreur');
        }

    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changerNiveau($id,$niveau,$profession,$dateDebut,$dateFin)
    {
         if (auth()->check()) {
                $souscripteur=Souscripteur::find($id);
                $souscripteur->niveauEtude=$niveau;
                $souscripteur->profession=$profession;
                $souscripteur->dateDebut=$dateDebut;
                $souscripteur->dateFin=$dateFin;
                $souscripteur->save();
              
                return response()->json([
                            'success' => 'Record deleted successfully!'
                        ]);
        }
        else
        {
            return view('erreur');
        }
       
    }


     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modifNiveauEtude($id)
    {
         if (auth()->check()) {
            $id=Crypt::encrypt($id);
            return redirect()->route('souscripteurs.modifNiveau',$id);
        }
        else
        {
            return view('erreur');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modifNiveau($id)
    {
         if (auth()->check()) {
            return view('modifNiveau',compact('id'));
        }
        else
        {
            return view('erreur');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modifEtude(Request $request)
    {
        $id=Crypt::decrypt($request->id);
        $souscripteur=Souscripteur::find($id);
        if ($souscripteur==null) {
            return view('erreur');
        }
        else
        {
            $souscripteur->niveauEtude=$request->niveauEtude;
            $souscripteur->profession=$request->profession;
            $souscripteur->dateDebut=$request->dateDebut;
            $souscripteur->dateFin=$request->dateFin;
            $souscripteur->save();

            return redirect()->route('souscripteurs.listeSelectionne');
    
        }
    
       
    }


     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genererAttestation($id)
    {
            // $id=auth()->user()->id;
            // $nomUtilisateur=auth()->user()->username;
            $souscripteur=Souscripteur::find($id);

            // $titre="attestation_".$souscripteur->nom."_".$souscripteur->prenom;
            $nom="attestation_".$souscripteur->nom."_".$souscripteur->prenom;
            
            $pdf=PDF::loadView('attestationPDF',compact('souscripteur'))->setPaper('a4', 'landscape');
            
           // return $pdf->download($nom);
            return $pdf->stream($nom);
            
        
    }


}
