<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        $questions = Question::all();
        return view('admin.questions.index', compact('questions', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Import a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importExcelToDB(Request $request)
    {
      $request->validate([
        'question_file' => 'required|mimes:xlsx'
      ]);
      if($request->hasFile('question_file')){
          $path = $request->file('question_file')->getRealPath();
          $data = \Excel::import($path)->get();
          if($data->count()){
              foreach ($data as $key => $value) {
                  $arr[] = ['topic_id' => $request->topic_id, 'question' => $value->question, 'a' => $value->a, 'b' => $value->b, 'c' => $value->c, 'd' => $value->d, 'answer' => $value->answer, 'code_snippet' => $value->code_snippet != '' ? $value->code_snippet : '-', 'answer_exp' => $value->answer_exp != '' ? $value->answer_exp : '-'];
              }
              if(!empty($arr)){
                  \DB::table('questions')->insert($arr);
                  return back()->with('added', 'Question Imported Successfully');
              }
              return back()->with('deleted', 'Your excel file is empty or its headers are not matched to question table fields');
          }
      }
        return back()->with('deleted', 'Request data does not have any files to import');
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
          'topic_id' => 'required',
          'question' => 'required',
          'a' => 'required',
          'b' => 'required',
          'c' => 'required',
          'd' => 'required',
          'answer' => 'required',
          'question_img' => 'image'
        ]);

        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();
            $file->move('images/questions/', $name);
            $input['question_img'] = $name;

        }

        Question::create($input);
        return back()->with('added', 'Question has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $questions = Question::where('topic_id', $topic->id)->get();
        return view('admin.questions.show', compact('topic', 'questions'));
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
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $request->validate([
          'topic_id' => 'required',
          'question' => 'required',
          'a' => 'required',
          'b' => 'required',
          'c' => 'required',
          'd' => 'required',
          'answer' => 'required',
        ]);

        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();

            if($question->question_img != null) {
                unlink(public_path().'/images/questions/'.$question->question_img);
            }

            $file->move('images/questions/', $name);
            $input['question_img'] = $name;

        }

        $question->update($input);
        return back()->with('updated', 'Question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        if ($question->question_img != null) {
            unlink(public_path().'/images/questions/'.$question->question_img);
        }

        $question->delete();
        return back()->with('deleted', 'Question has been deleted');
    }
}
