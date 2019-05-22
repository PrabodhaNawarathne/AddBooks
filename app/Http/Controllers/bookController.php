<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use Excel;
use Xml;
use App\Exports\exportBooks;
use App\Exports\exportAuthors;
use App\Exports\exportTitles;

use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;


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

    public function export(Request $request){
        if($request->input('exportcsv')!= null){
            return Excel::download(new exportBooks, 'Books & Authors.csv');
        }
        if($request->input('authorsCsv')!=null){
            return Excel::download (new exportAuthors, 'Authors.csv');
        }
        if($request->input('titlesCsv')!=null){
            return Excel::download (new exportTitles, 'Titles.csv');
        }
        return redirect()->route('books.index')->with('success','Book added to db');

      }


public function exportxml(Request $request){

    if($request->input('exportxml')!=null){

        $data = Books::all('title','author')->toArray();
        // $data = array_collapse($data);
        $result = ArrayToXml::convert(['book' => $data]);
        Storage::put('rss.xml', $result);

    }
    if($request->input('authorsXml')!= null){
        $data = Books::all('author')->toArray();
        $result = ArrayToXml::convert(['book' => $data]);
        Storage::put('authors.xml',$result);
    }
    if($request->input('titlesXml')!= null){
        $data = Books::all('title')->toArray();
        $result = ArrayToXml::convert(['book' => $data]);
        Storage::put('titles.xml',$result);
    }

    return redirect()->route('books.index')->with('success','Book added to db');
}
    public function exportAuthors(Request $request){
        if($request->input('authorsCsv')!=null){
            return Excel::download(new exportBooks, 'Authors List.csv');
        }
    }
}
