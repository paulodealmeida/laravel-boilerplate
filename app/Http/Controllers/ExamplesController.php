<?php

namespace App\Http\Controllers;

use App\Example;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExampleCreateRequest;
use App\Http\Requests\ExampleUpdateRequest;
use Illuminate\Http\Request;
use Validator;

class ExamplesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examples = Example::all();
        return view('examples.index', compact('examples'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examples.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $_request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $_request)
    {
        $fields = $_request->all();
        $validationRequest = new ExampleCreateRequest();
        $validator = Validator::make($fields, $validationRequest->rules(), $validationRequest->messages());

        if ($validator->fails()) {
            return redirect()->route('examples.create')
                            ->withErrors($validator->messages())
                            ->withInput();
        }

        $example = Example::create($fields);
        if ($example) {
            return redirect()->route('examples.index');
        } else {
            return redirect()->route('examples.create')
                            ->with('err', 'Não foi possivel salvar!')
                            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $_exampleId
     * @return \Illuminate\Http\Response
     */
    public function show($_exampleId)
    {
        $example = Example::find($_exampleId);
        if ($example) {
            return view('examples.show', compact('example'));
        } else {
            return redirect()->route('examples.index')
                            ->with('err', 'Não encontrado!')
                            ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $_exampleId
     * @return \Illuminate\Http\Response
     */
    public function edit($_exampleId)
    {
        $example = Example::find($_exampleId);
        if ($example) {
            return view('examples.edit', compact('example'));
        } else {
            return redirect()->route('examples.index')
                            ->with('err', 'Não encontrado!')
                            ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $_request
     * @param  int  $_exampleId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $_request, $_exampleId)
    {
        $fields = $_request->all();
        $validationRequest = new ExampleUpdateRequest();
        $validator = Validator::make($fields, $validationRequest->rules(), $validationRequest->messages());

        if ($validator->fails()) {
            return redirect()->route('examples.edit', $_exampleId)
                            ->withErrors($validator->messages())
                            ->withInput();
        }

        $example = Example::find($_exampleId);
        if ($example) {

            if ($example->update($fields)) {
                return redirect()->route('examples.index');
            } else {
                return redirect()->route('examples.edit', $_exampleId)
                                ->with('err', 'Não foi possivel salvar!')
                                ->withInput();
            }
        } else {
            return redirect()->route('examples.index')
                            ->with('err', 'Não encontrado!')
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $_exampleId
     * @return \Illuminate\Http\Response
     */
    public function destroy($_exampleId)
    {
        $example = Example::find($_exampleId);
        if ($example) {
            if ($example->delete()) {
                return redirect()->route('examples.index');
            } else {
                return redirect()->route('examples.index')
                                ->with('err', 'Não foi possivel excluir!')
                                ->withInput();
            }
        } else {
            return redirect()->route('examples.index')
                            ->with('err', 'Não encontrado!')
                            ->withInput();
        }
    }

}
