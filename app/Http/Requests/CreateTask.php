<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTask extends FormRequest
{
    protected $errorBag = 'create';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|max:255',
            'project'   => [
                'required',
                'integer',
                Rule::exists('projects', 'id')->where(function($query){
                    return $query->whereIn('id', $this->user()->projects()->pluck('id'));
                })
                /**
                 * 上面 exists 方法也可以写成
                 * Rule::exists('projects', 'id')->whereIn('id', $this->user()->projects()->pluck('id')->toArray())  //返回的是object 所以需要用 toArray 转换
                 */
            ]    
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => '任务名称是必须的',
            'name.max'        => '任务名称的长度超出了最大自负限制：255',
            'project.required'=> '没有提交当前任务所属项目的id',
            'project.integer' => '所提交的项目id无效（非证书）',
            'project.exists' => '所提交的项目id无效（当前用户无此项目）',
        ];
    }
}
