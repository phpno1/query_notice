<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/3/26
 * Time: 下午1:00
 */

namespace BugsLife\QueryNotice\Format\Database;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /*
     * View show.
     */
    const IS_DEAL = ['未处理', '已处理'];

    /*
     * Update data message.
     */
    const MSG = ['标记处理失败', '标记处理成功'];

    private $model;

    /**
     * NoticeController constructor.
     * @param QueryNoticeModel $queryNoticeModel
     */
    public function __construct(QueryNoticeModel $queryNoticeModel)
    {
        $this->model = $queryNoticeModel;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('query-notice.database.index');
    }

    /**
     * Get data.
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getData(Request $request)
    {
        if ($request->has('key')) {
            $this->model = $this->model
                ->where('query', 'like', $request->get('key') . '%')
                ->orWhere('controller', 'like', $request->get('key') . '%')
                ->orWhere('function', 'like', $request->get('key') . '%');
        }
        return response([
            'notices' => $this->model->orderBy('id', 'desc')
                ->paginate(
                    config('queryNotice.page'),
                    ['*'],
                    'page',
                    $request->get('page')
                ),
            'is_deal' => self::IS_DEAL,
        ]);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return response([
            'message' => self::MSG[$this->model->find($request->id)->update(['is_deal' => 1])]
        ]);
    }

}