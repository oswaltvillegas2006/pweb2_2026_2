<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sofa;
use App\Models\Categoriasofa;

class sofaController extends Controller
{
    public function index()
    {
        $dados = sofa::All();

        return view('sofa.list')->with(['dados' => $dados]);
    }

    function create()
    {
        $categorias = Categoriasofa::orderBy('nome')->get();

        return view('sofa.form', compact('categorias'));
    }


    function validateForm(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'cor' => 'required',
            'preco' => 'required',
        ], [
            'marca.required' => "O :attribute é obrigatorio",
            'cor.required' => "O :attribute é obrigatorio",
            'preco.required' => "O :attribute é obrigatorio"
        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        sofa::create($request->all());

        return redirect('sofa')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = sofa::find($id);
        $categorias = Categoriasofa::orderBy('nome')->get();

        // dd($data);
        //return view('sofa.form')->with(['data' => $data]);
        return view('sofa.form', [
            compact('data'),
            compact('categorias'),
        ]);
    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        sofa::find($id)->update($request->all());

        return redirect('sofa')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        sofa::destroy($id);

        return redirect('sofa')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = sofa::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = sofa::All();
        }

        return view('sofa.list', compact('dados'));
    }
}
