<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\User;
use App\Models\Report;
use App\Notifications\AppNotify;
use Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    function __constructor()
    {
        $this->middleware('permission:manage-tables', ['only' => ['store', 'update', 'updateExpens', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.materials', ['tables' => Table::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::all();
        $curuser = Auth::user();

        Table::create([
            // 'project' => $request->project,
            'name' => $request->name,
            'score' => $request->score,
            'codeprod' => $request->codeproduct,
            'unit' => $request->unit,
            'weight' => $request->weight,
            'size' => $request->size,
            'weight_one_material' => $request->weight * $request->size,
            'comingcur' => $request->comingcur,
            'size_unit' => $request->comingcur * $request->size,
            'general_weight' => $request->comingcur * $request->weight,
        ]);

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' добавил(-а) новую запись '.$request->name.' в таблицу. Счёт №: '.$request->score.'; Код продукта: '.$request->codeproduct
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Добавил(-а) запись '.$request->name
        ];

        Notification::send($user, new AppNotify($offerData));

        return redirect('/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Table::find($id);
        return $table->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, $id)
    {
        $table = Table::find($id);
        $user = User::all();
        $curuser = Auth::user();

        // $table->project = $request->project;
        $table->name = $request->name;
        $table->score = $request->score;
        $table->codeprod = $request->codeproduct;
        $table->unit = $request->unit;
        $table->weight = $request->weight;
        $table->size = $request->size;
        $table->weight_one_material = $request->weight * $request->size;
        $table->comingcur = $request->comingcur + $request->comingprev;
        $table->comingprev = $request->comingprev;
        $table->balancecur = $request->comingcur - $table->expenscur;
        $table->size_unit = $table->balancecur * $request->size;
        $table->general_weight = $table->balancecur * $request->weight;
        $table->save();

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' изменил(-а) запись '.$table->name.' в таблицу. Счёт №: '.$table->score.
            '; Код продукта: '.$table->codeprod.'; Текущ. приход: '.$table->comingcur.'; Пред. приход: '.$table->comingprev.'; Текущ. расход: '.$table->expenscur.
            '; Пред. расход: '.$table->expensprev.'; Текущ. остаток: '.$table->balancecur.'; Пред. остаток: '.$table->balanceprev
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Обновил(-а) запись '.$request->name
        ];

        Notification::send($user, new AppNotify($offerData));

        return redirect('/materials');
    }

    protected function updateExpens(Request $request, $id)
    {
        $table = Table::find($id);
        $user = User::all();
        $curuser = Auth::user();

        $table->expenscur = $request->expenscur + $request->expensprev;
        $table->expensprev = $request->expensprev;
        $table->balancecur = $table->comingcur - $table->expenscur;
        $table->balanceprev = $request->balanceprev;
        $table->size_unit = $table->balancecur * $table->size;
        $table->general_weight = $table->balancecur * $table->weight;
        $table->save();

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' изменил(-а) расход в записе '.$table->name.' в таблицу. Счёт №: '.$table->score.
            '; Код продукта: '.$table->codeprod.'; Текущ. приход: '.$table->comingcur.'; Пред. приход: '.$table->comingprev.'; Текущ. расход: '.$table->expenscur.
            '; Пред. расход: '.$table->expensprev.'; Текущ. остаток: '.$table->balancecur.'; Пред. остаток: '.$table->balanceprev
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Изменил(-а) израсходованное кол-во в записе'.$request->name
        ];

        Notification::send($user, new AppNotify($offerData));

        return redirect('/materials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        $user = User::all();
        $curuser = Auth::user();

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Удалил(-а) запись '.$table->name
        ];

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' удалил(-а) запись '.$table->name.' в таблицу. Счёт №: '.$table->score.'; Код продукта: '.$table->codeprod
        ]);

        $table->delete();

        Notification::send($user, new AppNotify($offerData));

        return redirect('/materials');
    }
}
