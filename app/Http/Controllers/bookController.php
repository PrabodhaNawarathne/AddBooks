<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use Excel;
use App\Exports\exportBooks;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all()->toArray();
        return view ('books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = $this->validate(request(), [
            'title' => 'required',
            'author' => 'required'


        ]);
        books::create($books);

        // return back()->with('success','Book added to db');
        return redirect()->route('books.index')->with('success','Book added to db');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Books::find($id);
        return view ('books.edit', compact('books','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required'
        ]);
        $books = Books::find($id);
        // $books -> title = $request->get('title');
        $books -> author = $request->get('author');

        $books->save();
        return redirect()->route('books.index')->with('success', 'Author updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books = Books::find($id);
        $books->delete();

        return redirect()->route('books.index')->with('success','Record deleted');
    }

    public function cvsExport(){
       return (new exportBooks)->download('MyBooks.csv', \Maatwebsite\Excel\Excel::CSV);

    }
    public function excelExport()
    {
        return (new exportBooks)->download('MyBooks.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        // return Excel::store('sample',function($excel) use ($books){
        //     $excel->$sheet('sheet name', function($sheet) use ($books){
        //         $sheet->fromArray($books);
        //     });
        // })->download('csv');

        // return Excel::create('example', function($excel) use($books){
        //     $excel->sheet('mysheet', function($sheet) use($books){
        //         $sheet->fromArray($books);
        //     });
        // })->download('xlsx');

        // $booksArray[] = array('id','Title','Author','created_at','updated_at');

        // foreach($books as $book)
        // {
        //     $booksArray = array(
        //         'id' => $book->id,
        //         'Title' => $book->title,
        //         'Author' => $book->author,
        //         'created_at' => $book->created_at,
        //         'updated_at' => $book->updated_at
        //     );
        //     echo $book;
        // }
        // Excel::create('Books & Authors', function($excel) use($booksArray){
        //     $excel->setTitle('Books & Authors');
        //     $excel->sheet('Books & Authors', function($sheet) use($booksArray){
        //         $sheet->fromArray($booksArray,null,'A1',false,false);

        //     });
        // })->download('xlsx');
    }
}
