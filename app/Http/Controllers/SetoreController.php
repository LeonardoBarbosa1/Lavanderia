<?php

namespace App\Http\Controllers;

use App\Models\Setore;
use App\Exports\SetoresExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class SetoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setores = Setore::when($request->term, function ($query, $term) {
            $query->where("updated_by", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("descricao", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($setore) {
                return [
                    'id' => $setore->id,
                    "status" => $setore::getStatusByID($setore->status),
                    "descricao" => $setore->descricao,

                ];
            });
            
        return Inertia::render('Setore/Index', [
            'setores' => $setores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render('Setore/Create', [
            'status' => $status
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'descricao' => 'required',

        ]);

        Setore::create($request->all());
        return Redirect::route('setores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setore  $setore
     * @return \Illuminate\Http\Response
     */
    public function show(Setore $setore)
    {
        $status=$setore::getStatusByID($setore->status);
        return Inertia::render('Setore/Show', [
            'setore' => $setore,
            'status' => $status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setore  $setore
     * @return \Illuminate\Http\Response
     */
    public function edit(Setore $setore)
    {
        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render(
            'Setore/Update',
            [
                'setore' => $setore,
                'status' => $status
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setore  $setore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setore $setore)
    {
        $setore->update($request->all());
        return Redirect::route('setores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setore  $setore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setore $setore)
    {
        $setore->delete();
        return Redirect::route('setores.index');
    }

    public function export(Request $request)
    {
        return (new SetoresExport($request->term))->download('setores.xlsx');
    }
}
