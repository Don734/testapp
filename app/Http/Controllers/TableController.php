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
        $this->middleware('permission:manage-tables', ['only' => ['store', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.wh', ['tables' => Table::all()]);
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
            'project' => $request->project,
            'description' => $request->description,
            'name' => $request->name,
            'score' => $request->score,
            'codeprod' => $request->codeproduct,
            'unit' => $request->unit,
            'comingcur' => $request->comingcur
        ]);

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' добавил(-а) новый проект '.$request->project.' в таблицу. Наименование: '.$request->name.
            '; Счёт №: '.$request->score.'; Код продукта: '.$request->codeproduct
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Добавил проект '.$request->project.'. Наименование: '.$request->name
        ];

        if ($curuser->notifiable == 1) {
            Notification::send($user, new AppNotify($offerData));
        }

        return redirect('/tables');
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

        $table->project = $request->project;
        $table->description = $request->description;
        $table->name = $request->name;
        $table->score = $request->score;
        $table->codeprod = $request->codeproduct;
        $table->unit = $request->unit;
        $table->comingcur = $request->comingcur + $request->comingprev;
        $table->comingprev = $request->comingprev;
        $table->balancecur = $table->comingcur - $table->expenscur;
        $table->save();

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' изменил(-а) проект '.$table->project.' в таблицу. Наименование: '.$table->name.'; Счёт №: '.$table->score.
            '; Код продукта: '.$table->codeprod.'; Текущ. приход: '.$table->comingcur.'; Пред. приход: '.$table->comingprev.'; Текущ. расход: '.$table->expenscur.
            '; Пред. расход: '.$table->expensprev.'; Текущ. остаток: '.$table->balancecur.'; Пред. остаток: '.$table->balanceprev
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Обновил проект '.$request->project.'. Наименование: '.$request->name
        ];

        if ($curuser->notifiable == 1) {
            Notification::send($user, new AppNotify($offerData));
        }

        return redirect('/tables');
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
        $table->save();

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' изменил(-а) расход в проекте '.$table->project.' в таблицу. Наименование: '.$table->name.'; Счёт №: '.$table->score.
            '; Код продукта: '.$table->codeprod.'; Текущ. приход: '.$table->comingcur.'; Пред. приход: '.$table->comingprev.'; Текущ. расход: '.$table->expenscur.
            '; Пред. расход: '.$table->expensprev.'; Текущ. остаток: '.$table->balancecur.'; Пред. остаток: '.$table->balanceprev
        ]);

        $offerData = [
            'name' => $curuser['fullname'],
            'message' => 'Изменил израсходованное кол-во в проекте'.$request->project.'. Наименование: '.$request->name
        ];

        if ($curuser->notifiable == 1) {
            Notification::send($user, new AppNotify($offerData));
        }

        return redirect('/tables');
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
            'message' => 'Удалил проект '.$table->project.'. Наименование: '.$table->name
        ];

        Report::create([
            'desc' => 'Пользователь '.$curuser->fullname.' удалил(-а) проект '.$table->project.' в таблицу. Наименование: '.$table->name.
            '; Счёт №: '.$table->score.'; Код продукта: '.$table->codeprod
        ]);

        $table->delete();

        if ($curuser->notifiable == 1) {
            Notification::send($user, new AppNotify($offerData));
        }

        return redirect('/tables');
    }
}
