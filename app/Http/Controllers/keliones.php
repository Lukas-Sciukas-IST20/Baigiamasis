<?php

namespace App\Http\Controllers;

use App\Models\kelione;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\DB;

class keliones extends Controller
{
    public function index()
    {
        
        $date = date('Y-m-d h:i:s', time());
        $keliones= DB::table('keliones')->where('visibility','=','matomas')->where('isvykimas','>',$date)->join("transportas","transportas.id","=","keliones.transporto_id")->select("keliones.*","transportas.vietos")->orderBy('isvykimas','asc')->paginate(5);
        $uzsakymai = DB::table('uzsakymai')->get();
        $x = 0;
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
        $vairuotojai=DB::table('users')->where('tipas','=','2')->get();
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                $nematomos = DB::table('keliones')->where('visibility','=','nematomas')->orderBy('isvykimas','asc')->get();
                return view('kelione',compact('keliones','nematomos','vairuotojai','vietos')); 
            }
        }
        return view('kelione',compact('keliones','vietos')); 
    }
    public function create()
    {
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                $vairuotojai = DB::table('users')->where('tipas','=','2')->where('deleted_at',NULL)->get();
                $transportas = DB::table('transportas')->where('deleted_at',NULL)->get();
                return view('kelionecreate',compact('vairuotojai','transportas'));
            }
        }
        return redirect()->route('keliones.index'); 
    }
    public function edit($id)
    {
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                $vairuotojai = DB::table('users')->where('tipas','=','2')->where('deleted_at',NULL)->get();
                $kelione= DB::table('keliones')->where('id','=',$id)->first();
                $transportas = DB::table('transportas')->get();
                return view('kelioneedit',compact('kelione','vairuotojai','transportas'));
            }
        }
        return redirect()->route('keliones.index');
    }
    public function update(Request $request,$id)
    {
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                $update= DB::table('keliones')->where('id',$id)->update([
                    'pradzia_salis' => $request->pradzia_salis,
                    'pradzia_miestas' => $request->pradzia_miestas,
                    'stotis' => $request->stotis,
                    'aprasymas' => $request->aprasymas,
                    'vairuotojo_id' => $request->vairuotojo_id,
                    'tikslas_salis' => $request->tikslas_salis,
                    'tikslas_miestas' => $request->tikslas_miestas,
                    'transporto_id' => $request->transporto_id,
                    'kaina_suaug' => $request->kaina_suaug,
                    'kaina_vaikam' => $request->kaina_vaikam,
                    'isvykimas' => $request->isvykimas,
                    'gryzimas' => $request->gryzimas,
                    'pavadinimas' => $request->pavadinimas,
                    'visibility' => $request->visibility,
                ]);
            }
        }
        return redirect()->route('keliones.index');
    }
    public function store(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->tipas > 2)
            {
                kelione::create($request->all());
            }
        }
        return redirect()->route('keliones.index');
    }
    public function show($id)
    {
        $kelione= DB::table('keliones')->where('keliones.id','=',$id)->join("transportas","transportas.id","=","keliones.transporto_id")->select("keliones.*","transportas.vietos")->first();
        $vairuotojas=DB::table('users')->where('id','=',$kelione->vairuotojo_id)->first();
        $keleiviai = DB::table('uzsakymai')->where('keliones_id','=',$kelione->id)->get();
        $laisvos=$kelione->vietos-count($keleiviai);
        return view('kelioneshow',compact('kelione','keleiviai','laisvos','vairuotojas')); 
    }
}
