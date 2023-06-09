<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\DB;

class filtruotoskeliones extends Controller
{
    public function index(Request $request)
    {
        
        $date = date('Y-m-d h:i:s', time());
        $filtrai = $request->all();
        $keliones= DB::table('keliones')->where('visibility','=','matomas')->where('isvykimas','>',$date)->join("transportas","transportas.id","=","keliones.transporto_id")->select("keliones.*","transportas.vietos")->orderBy('isvykimas','asc');
        if(isset($filtrai['minkaina']))
        {
            $keliones->where('kaina_suaug','>=',$filtrai['minkaina']);
        }
        if(isset($filtrai['maxkaina']))
        {
            $keliones->where('kaina_suaug','<=',$filtrai['maxkaina']);
        }
        if(isset($filtrai['datenuo']))
        {
            $keliones->where('isvykimas','>=',$filtrai['datenuo']);
        }
        if(isset($filtrai['dateiki']))
        {
            $keliones->where('isvykimas','<=',$filtrai['dateiki']);
        }  
        if(isset($filtrai['norimsalis']))
        {
            $keliones->where('tikslas_salis','like',$filtrai['norimsalis']);
        } 
        if(isset($filtrai['norimmiest']))
        {
            $keliones->where('tikslas_miestas','like',$filtrai['norimmiest']);
        } 
        $keliones=$keliones->paginate(5);
        $uzsakymai = DB::table('uzsakymai')->get();
        $x = 0;
        $vairuotojai=DB::table('users')->where('tipas','=','2')->get();
        $vietos = [];
        foreach($keliones as $kelione)
        {
            $uzimtos = 0;
            foreach($uzsakymai as $uzsakymas)
            {
                if($uzsakymas->keliones_id == $kelione->id)
                {
                    $uzimtos++;
                }
            }
            $vietos[$kelione->id]=$kelione->vietos-$uzimtos;
        }
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                $nematomos = DB::table('keliones')->where('visibility','=','nematomas')->orderBy('isvykimas','asc')->get();
                return view('kelione',compact('keliones','nematomos','vairuotojai','vietos')); 
            }
        }
        return view('kelione',compact('keliones','vietos')); 
    }
    //
}
