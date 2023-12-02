<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class etudiantcontroller extends Controller
{
    public function liste_etudiant()
    {
      $etudiants = Etudiant::paginate(4);
     return view('etudiant.liste', compact('etudiants'));   
    }
    
    public function ajouter_etudiant()
    
    
    {
      return view('etudiant.ajouter');  
    }
    
    public function ajouter_etudiant_traitement(Request $request)
    {
      $request->validate([
        'Nom' => 'required',
        'Prenom' => 'required',
        'Classe' => 'required',
      ]);
      $etudiant = new Etudiant();
      $etudiant ->Nom = $request->Nom;
      $etudiant ->Prenom = $request->Prenom;
      $etudiant ->Classe = $request->Classe;
      $etudiant ->save();
      
      return redirect('/ajouter')->with('status', 'L\'etudiant a bien ete ajouter avec succes.');
    }
   
    public function update_etudiant($id){
      $etudiants = Etudiant::find($id);
      
      return view('etudiant.update', compact('etudiants'));
    }
    public function update_etudiant_traitement(Request $request){
      
      $request->validate([
        'Nom' => 'required',
        'Prenom' => 'required',
        'Classe' => 'required',
      ]);
      $etudiant = Etudiant::find($request->id);
      $etudiant ->Nom = $request->Nom;
      $etudiant ->Prenom = $request->Prenom;
      $etudiant ->Classe = $request->Classe;
      $etudiant ->update();
      return redirect('/etudiant')->with('status', 'L\'etudiant a bien ete modifier avec succes.');
    }
    
    public function delete_etudiant($id){ 
      $etudiant = Etudiant::find($id);
      $etudiant->delete();
      return redirect('/etudiant')->with('status', 'L\'etudiant a bien ete suprimer avec succes.');
    }  
    
    
}
