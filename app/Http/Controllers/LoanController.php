<?php

namespace App\Http\Controllers;

use App\Events\CopyWasLoaned;
use Carbon\Carbon;
use App\Models\Copy;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.loan.index', [
            'loans' => Loan::latest()->paginate(8)
        ]);
    }

    public function front_index()
    {
        return view('frontoffice.loan.index', [
            'loans' => Loan::where('user_id', auth()->user()->id)->latest()->paginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.loan.create', [
            'readers' => User::all()->filter(function ($user) {
                return $user->hasRole('Reader');
            }),
            'copies' => Copy::all()->filter(function ($user) {
                return $user->state === 'Disponible';
            })
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
        //dd($request);
        $request->validate([
            'reader' => 'required|numeric',
            'copy' => 'required|numeric',
            'limit_date' => 'required'
        ]);

        if(Carbon::now()->toDateString() < now()->toDateString()) {
            return redirect()->back()->with('error', '¡Error! la fecha de préstamo debe ser mayor a la actual');
        } elseif ($request['limit_date'] < Carbon::now()->toDateString()) {
            return redirect()->back()->with('error', '¡Error! la fecha límite de devolución debe ser mayor a la fecha del préstamo');
        } elseif (Carbon::parse($request['limit_date'])->diffInDays(Carbon::parse(Carbon::now()->toDateString())) > 30) {
            return redirect()->back()->with('error', '¡Error! el préstamo no puede ser mayor a 30 días');
        }

        Loan::create([
            'start_date' => Carbon::now()->toDateString(),
            'limit_date' => $request['limit_date'],
            'user_id' => $request['reader'],
            'copy_id' => $request['copy']
        ]);

        if(Carbon::now()->toDateString() === now()->toDateString()) {
            CopyWasLoaned::dispatch($request['copy']);
        }

        return redirect()->route('loan.index')->with('success', '¡El préstamo fue creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('backoffice.loan.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $loan->copy()->update([
            'state' => 'Disponible'
        ]);

        $loan->delete();

        return redirect()->route('loan.index')->with('success', '¡El préstamo ha sido cancelado exitosamente!');
    }

    public function update_devolution (Request $request, Loan $loan)
    {
        $loan->update([
            'devolution_date' => Carbon::now()->toDateString()
        ]);

        $loan->copy()->update([
            'state' => 'Disponible'
        ]);

        return redirect()->back()->with('success', '¡La copia ha sido devuelta exitosamente!');
    }
}
