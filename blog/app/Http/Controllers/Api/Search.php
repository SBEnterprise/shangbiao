<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//201709.24 搜索测试
class Search extends Controller
{
    protected $xs;

    //模糊搜索
    protected $fuzzy;

    //同义词搜索
    protected $synonyms;


    /**
     * __construct description
     * @param string  $configFile xunsearch的配置文件名
     * @param boolean $fuzzy      模糊搜索 true为开启 false关闭模糊
     * @param boolean $synonyms   同义词搜索 true为开启
     */
    public function __construct(
      $configFile = 'shop',
      $fuzzy = true,
      $synonyms = true
    )
    {

        define ('XS_APP_ROOT', '/usr/local/xunsearch/sdk/php/app');


        $this->xs = new \XS($configFile);
       // dd($this->xs);
        $this->fuzzy = $fuzzy;
        $this->synonyms = $synonyms;

        //获取搜索对象
        $this->search = $this->xs->search;
    }


    /**
     * doSearch 使用xunsearch进行搜索
     * @param  string $keyword 搜索词语 用户从表单填写的要搜索的内容
     * @return array           搜索结果
     */
    public function doSearch($keyword)
    {

        $this->search
        ->setFuzzy($this->fuzzy)
        ->setAutoSynonyms($this->synonyms);

        //设置搜索语句
        $res = $this->search->setQuery($keyword);

        //执行搜索，将搜索结果文档保存在 $docs 数组中
        $docs =  $this->search->search();

        if(count($docs) == 0){

          // 没有找到搜索结果
          return array();
        }

        //将结果一一取出
		    foreach($docs as $k => $doc){
    		    if(!empty($doc)){

    				    //取出搜索结果
    				    $searchRes[] = $doc->getFields();

    				    //获取每个词的权重
    				    $searchRes[$k]['weight'] = $doc->weight();

    		    }
		    }

       return $searchRes;

    }

    /*
     * addDocumentData 添加数据到xunsearch索引服务器
     * @param array $data 如果需要将商品名加入搜索服务器，就传递
     * $data = ['gname' => '你的商品名'], gname需要与xunsearch配置文件中一致
     * @return  void
     */
    public function addDocumentData( $data = array() )
    {
        if ( empty($data) ) {
          throw new \Exception('请输入插入数据');
        }

        $doc = new \XSDocument;

        $doc->setFields($data);

        //添加索引到xunsearch中
        $this->xs->index->add($doc);
    }

    //更新索引库的索引
    public function updateDocumentData( $data = array() )
    {
        if ( empty($data) ) {
            throw new \Exception('请选择索引更新');
        }

        $doc = new \XSDocument;

        $doc->setFields($data);

        //修改索引库的索引
        $this->xs->index->update($doc);
    }

    //删除索引数据库中的数据
    public function delDocumentData($data)
    {
        if( empty($data) ) {
            throw new \Exception('请指定删除的索引');
        }

        $this->xs->index->del($data);
    }


    //清空索引
    public function cleanIndex()
    {
        $this->xs->index->clean();
    }

}
