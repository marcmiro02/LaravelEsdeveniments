<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        // Aquí puedes listar los PDFs generados o cualquier otra lógica
        return view('pdf.index');
    }

    public function show($id)
    {
        // Aquí puedes mostrar un PDF específico
        return view('pdf.show', compact('id'));
    }

    public function create()
    {
        // Aquí puedes mostrar un formulario para crear un nuevo PDF
        return view('pdf.create');
    }

    public function store(Request $request)
    {
        // Aquí puedes manejar la lógica para almacenar un nuevo PDF
        // Por ejemplo, puedes validar y guardar datos en la base de datos
        $request->validate([
            'data' => 'required',
        ]);

        // Lógica para almacenar el PDF

        return redirect()->route('pdf.index')->with('success', 'PDF creat correctament');
    }

    public function edit($id)
    {
        // Aquí puedes mostrar un formulario para editar un PDF existente
        return view('pdf.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Aquí puedes manejar la lógica para actualizar un PDF existente
        $request->validate([
            'data' => 'required',
        ]);

        // Lógica para actualizar el PDF

        return redirect()->route('pdf.index')->with('success', 'PDF actualitzat correctament');
    }

    public function destroy($id)
    {
        // Aquí puedes manejar la lógica para eliminar un PDF existente
        // Lógica para eliminar el PDF

        return redirect()->route('pdf.index')->with('success', 'PDF eliminat correctament');
    }

    public function pdf()
{
    $data = [
        'eventName' => 'Concert de Rock',
        'eventDate' => '2023-12-31',
        'eventTime' => '20:00',
        'eventLocation' => 'Estadi Olímpic',
        'eventOrganizer' => 'Rock Events',
        'ticketPrice' => 50,
        'discount' => 10,
        'totalPrice' => 40,
        'row' => 'A',
        'seat' => 12,
        //qr aqui tambe
    ];

    $pdf = PDF::loadView('pdf.pdf', $data);

    return $pdf->stream('entrada.pdf');
}
}