<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProduceBomsAction
 *
 * @author nemo
 */
class ProduceBomsAction extends CommonAction {
    
    protected $workflowAlias = "produce";
    
    public function read() {
        
        $model = D("ProduceBomsView");
        $rows = $model->where("ProduceBoms.plan_id=".$_GET["id"])->select();
//        echo $model->getLastSql();
        $modelIds = array();
        foreach($rows as $k=>$v) {
            $tmp = explode("-", $v["factory_code_all"]); //根据factory_code_all factory_code - standard - version
            $factory_code = array_shift($tmp);
//            $rows[$k]["stock"] = $v["stock_id"];
//            $rows[$k]["goods_id"] = $v["factory_code_all"];
            $modelIds = array_merge($modelIds, $tmp);
            $rows[$k]["modelIds"] = $tmp;
        }
        $dataModel = D("DataModelDataView");
        $rows = $dataModel->assignModelData($rows, $modelIds);
//        print_r($rows);exit;
        $data = array(
            "rows" => $rows
        );
        $this->response($data);
    }
    
    public function update() {
        print_r($_POST);exit;
    }
    
}
