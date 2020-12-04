<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

/*
Exemple de route simple
Route::get('1', function(){return 'Page 1';});
Route::get('2',function(){return 'Page 2';});

Exemple de route avec parametre
Route::get('{n}', function($n){return 'Page '.$n;});

Exemple de route avec un parametre optionnel
Route::get('{n?}',function($n=1){return 'page '.$n;});

Exemple de route avec une contrainte sur le parametre
Route::get('{n}', function($n){ return 'Page '.$n;})->where('n','[1-3]');

Exemple de route nommée
Route::get('/inscription',function(){return 'Page inscription';})->name('inscriptions');

Exemple de route paramétréé avec renvoie d'une vue
Route::get('inscrit/{n}',function($n){
	return view('inscrit')->with('n',$n);
})->where('n','[0-9]+');
*/

Route::get('inscription', 'InscriptionController@create');
Route::post('inscription','InscriptionController@store');

Route::get('souscripteur/formulaireValidation/{id}','SouscripteurController@getFormulaireValidation')->name('souscripteurs.validation');
Route::post('souscripteur/validation','SouscripteurController@validerSouscription');
Route::post('souscripteur/validationOperateur','SouscripteurController@validerSouscriptionOperateur');
Route::get('souscripteur/validationCode/{id}','SouscripteurController@validerCode')->name('souscripteurs.validerCode');
Route::post('souscripteur/validationCode','SouscripteurController@validerSouscriptionCode');
Route::get('souscripteur/validationQuittance/{id}','SouscripteurController@validerQuittance')->name('souscripteurs.validerQuittance');
Route::post('souscripteur/validationQuittance','SouscripteurController@validerSouscriptionQuittance');
Route::get('souscripteur/notification/enregistrer','SouscripteurController@notificationSave')->name('souscripteurs.notificationSave');

Route::get('souscripteurs/modification','SouscripteurController@preEdite');
Route::post('souscripteurs/modification','SouscripteurController@edition');
Route::get('souscripteurs/edition/{id}','SouscripteurController@editionSouscription')->name('souscripteurs.editionSouscription');

Route::get('souscripteurs/verification','SouscripteurController@verifierSouscription');
Route::post('souscripteurs/verification','SouscripteurController@verification');
Route::get('souscripteurs/update/notification','SouscripteurController@notifieEdit')->name('souscripteurs.notifEdit');

Route::get('souscripteurs/suivieDossier','SouscripteurController@preSuivie');
Route::post('souscripteurs/suivieDossier','SouscripteurController@suivieDossier');


Route::get('souscripteurs/liste','SouscripteurController@liste');
Route::get('provinces/{id}','SouscripteurController@provinces');
Route::get('departements/{id}','SouscripteurController@departements');
Route::get('localites/{id}','SouscripteurController@localites');
Route::resource('souscripteur', 'SouscripteurController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('souscripteurs/listepdf','SouscripteurController@genererPDF');
Route::get('souscripteurs/listeexcel','SouscripteurController@genererExcel');
Route::get('souscripteurs/preselectionne/listepdf','SouscripteurController@genererPreselectionnePDF');
Route::get('souscripteurs/preselectionne/listeexcel','SouscripteurController@genererPreselectionneExcel');
Route::get('souscripteurs/preselectionne2/listepdf','SouscripteurController@genererPreselectionne2PDF');
Route::get('souscripteurs/preselectionne2/listeexcel','SouscripteurController@genererPreselectionne2Excel');
Route::get('souscripteurs/selectionne/listepdf','SouscripteurController@genererSelectionnePDF');
Route::get('souscripteurs/selectionne/listeexcel','SouscripteurController@genererSelectionneExcel');
Route::get('souscripteurs/nonSelectionne/listepdf','SouscripteurController@genererNonSelectionnePDF');
Route::get('souscripteurs/nonSelectionne/listeexcel','SouscripteurController@genererNonSelectionneExcel');
Route::get('souscripteurs/mesListepdf','SouscripteurController@genererMesListePDF');
Route::get('souscripteurs/mesListeexcel','SouscripteurController@genererMesListeExcel');

Route::get('souscripteurs/listeVague1','SouscripteurController@listeVague1')->name('souscripteurs.listeVague1');
Route::get('souscripteurs/listeVague2','SouscripteurController@listeVague2')->name('souscripteurs.listeVague2');
Route::get('souscripteurs/listeSelectionne','SouscripteurController@listeSelectionne')->name('souscripteurs.listeSelectionne');
Route::get('souscripteurs/listeNonSelectionne','SouscripteurController@listeNonSelectionne');
Route::get('souscripteurs/operateur/liste','SouscripteurController@operateurListe');
Route::get('souscripteur/modification/{id}','SouscripteurController@modification');

Route::get('souscripteur/JoindreAttestation/{id}','SouscripteurController@joindreAttestation')->name('souscripteurs.joindreAttestation');
Route::post('souscripteur/attestationJoint','SouscripteurController@attestationJoint');

Route::get('operateurs/listeSouscripteurs','SouscripteurController@operaListeSouscripteur');
Route::get('operateurs/{id}','SouscripteurController@listeSouscripteurOpera');

Route::get('utilisateurs','UserController@index');
Route::get('utilisateurs/delete/{id}','UserController@delete');
Route::get('utilisateurs/modificationUsername/','UserController@editUsername')->name('editUsername');
Route::put('utilisateurs/updateUsername/{user}','UserController@updateUsername')->name('updateUsername');
Route::get('utilisateurs/modificationPassword/','UserController@editPassword')->name('editPassword');
Route::put('utilisateurs/updatePassword/{user}','UserController@updatePassword')->name('updatePassword');

Route::get('souscripteurs/formationjeune','SouscripteurController@formationJeune');


Route::get('souscripteurs/sendEmail','SouscripteurController@sendEmail');
Route::get('projetFormation','FormationController@projetFormation');
Route::get('aneree','FormationController@infoANEREE');
Route::get('souscription/aide','FormationController@souscriptionAide');

Route::get('espace/recruteur','SouscripteurController@recruteurLogin');
Route::get('espace/recruteur/accueil','SouscripteurController@recruteurAccueil');
Route::get('recruteur/region/{id}','SouscripteurController@souscripteursRegion');
Route::get('recruteur/province/{id}','SouscripteurController@souscripteursProvince');

Route::get('selection/{id}','SouscripteurController@selection');
Route::get('souscripteurs/selection/{id}','SouscripteurController@selection1');
Route::get('selection2/{id}','SouscripteurController@selection2');
Route::put('nonSelection/{id}','SouscripteurController@nonSelection');

Route::get('uploads/{nom}','SouscripteurController@download');
Route::get('uploads/attestation/{nom}','SouscripteurController@downloadAttestation');


Route::get('formation/nom/{nom_Id}','SouscripteurController@souscripteursNom');
Route::get('formation/prenom/{nom}/{prenom}','SouscripteurController@souscripteursPrenom');
Route::get('souscripteurs/rechercher','SouscripteurController@rechercher')->name('rechercher');
Route::post('souscripteurs/recherche','SouscripteurController@recherche');
Route::get('recherche/selection/{id}','SouscripteurController@rechercheSelection');
Route::get('forme/nom/{nom_Id}','SouscripteurController@souscripteursFormeNom');
Route::get('forme/prenom/{nom}/{prenom}','SouscripteurController@souscripteursFormePrenom');


Route::get('souscripteurs/nonForme/{id}','SouscripteurController@nonForme');

Route::get('souscripteurs/rechercheAvancee','SouscripteurController@rechercheAvancee')->name('rechercheAvancee');
Route::post('souscripteurs/rechercheAvancee
	','SouscripteurController@rechercheAvance');
Route::get('souscripteurs/genererPDF/{nom}','SouscripteurController@downloadListeSouscripteur');

Route::get('souscripteurs/genererListePDF/{idMin}/{idMax}/{numPage}','SouscripteurController@genererListePDF');

Route::get('souscripteurs/selectionne/genererListeSelectionneePDF/{idMin}/{idMax}/{numPage}','SouscripteurController@genererListeSelectionneePDF');

Route::get('souscripteurs/genererListeExcel/{idMin}/{idMax}/{numPage}','SouscripteurController@genererListeExcel');


Route::put('changerNiveau/{id}/{niveau}/{profession}/{dateDebut}/{dateFin}','SouscripteurController@changerNiveau');

Route::get('souscripteurs/modifNiveauEtude/{id}','SouscripteurController@modifNiveauEtude');
Route::get('souscripteurs/modifNiveau/{id}','SouscripteurController@modifNiveau')->name('souscripteurs.modifNiveau');
Route::post('modifEtude','SouscripteurController@modifEtude');

Route::get('generation/attestation/{id}','SouscripteurController@genererAttestation');
