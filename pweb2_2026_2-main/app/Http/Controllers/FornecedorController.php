<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\CategoriaCliente;

class ClienteController extends Controller
{
    public function index()
    {
        $dados = Cliente::All();

        return view('Cliente.list')->with(['dados' => $dados]);
    }

    function create()
    {
        $categorias = CategoriaCliente::orderBy('nome')->get();

        return view('Cliente.form', compact('categorias'));
    }


    function validateForm(Request $request)
    {
        $request->validate([
            'empresa' => 'required',
            'cnpj' => 'required',
            'categoria_id' => 'required',
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'cnpj.required' => "O :attribute é obrigatorio",
            'categoria_id.required' => "O :attribute é obrigatorio"
        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        Cliente::create($request->all());

        return redirect('Cliente')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Cliente::find($id);
        $categorias = CategoriaCliente::orderBy('nome')->get();

        // dd($data);
        //return view('Cliente.form')->with(['data' => $data]);
        return view('Cliente.form', [
            compact('data'),
            compact('categorias'),
        ]);
    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        Cliente::find($id)->update($request->all());

        return redirect('Cliente')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Cliente::destroy($id);

        return redirect('Cliente')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Cliente::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Cliente::All();
        }

        return view('Cliente.list', compact('dados'));
    }
}
