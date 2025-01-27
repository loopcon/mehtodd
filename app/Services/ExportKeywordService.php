<?php

namespace App\Services;

use App\Models\Category;

class ExportKeywordService
{
    public $wordToFind = 'index';

    function TreeView($project_id)
    {
        $str = [];

        $mainList = Category::where('project_id', $project_id)->where('sub_category_id', '0')->get();

        foreach ($mainList as $key => $value) {
            $arr = [];

            $categorylist = Category::where('main_cat_id', $value->main_cat_id)->get();


            if (count($categorylist) <= 0) {
                return null;
            }

            foreach ($categorylist as $row) {
                $arr[$row->id]['id'] = $row->id;
                $arr[$row->id]['name'] = $row->name;
                $arr[$row->id]['sub_category_id'] = $row->sub_category_id;
            }

            $str[] = $this->buildTreeView($arr, 0, 0, -1);
        }
        return $str;
    }

    function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
    {
        global $mainArr;
        global $i;
        $th = true;
        foreach ($arr as $id => $data) {

            if ($parent == $data['sub_category_id']) {

                if ($parent == 0) {

                    if ($i == 0) {

                        $mainArr[] = $data['name'];
                        $i++;
                        $th = false;

                        $keywords = GetKeyWordData($data['id']);
                        foreach ($keywords as $key =>  $value) {
                            if ($value !== null) {

                                $keyword = $this->GetKeywordString($value);
                                $mainArr[] = $keyword;
                            }
                        }
                    } else {
                        $mainArr = [];
                        $mainArr[] = $data['name'];
                        $th = false;
                        $keywords = GetKeyWordData($data['id']);

                        foreach ($keywords as $key =>  $value) {
                            if ($value !== null) {
                                $keyword = $this->GetKeywordString($value);
                                $mainArr[] = $keyword;
                            }
                        }
                    }
                    $mainArr[] = "";
                    $mainArr[] = "";
                }
                if ($data['name'] != "") {

                    if ($th == true) {
                        $mainArr[] = $data['name'];
                        $keywords = GetKeyWordData($data['id']);

                        if (count($keywords) > 0) {
                            $volumeString = GetKeywordVolume($keywords);
                            $mainArr[] = $volumeString;
                        }

                        $keywords = GetKeyWordData($data['id']);
                        foreach ($keywords as $key =>  $value) {
                            if ($value !== null) {
                                $keyword = $this->GetKeywordString($value);
                                $mainArr[] = $keyword;
                            }
                        }
                        $mainArr[] = "";
                        $mainArr[] = "";
                    }

                    if ($level > $prelevel) {
                        $level = $prelevel;
                    }
                    $level++;
                    $this->buildTreeView($arr, $id, $level, $prelevel);
                    $level--;
                }
            }
        }
        return $mainArr;
    }
    public function GetKeywordString(array $value): string
    {
        return $value['index_id'] . ' ' . $this->wordToFind . ' '  . $value['keyword'];;
    }
    public function GetKeywordExcelArray($dataArray): array
    {
        $maxCount = 0;
        foreach ($dataArray as $subArray) {
            $maxCount = max($maxCount, count($subArray));
        }

        $newArray = [];
        for ($i = 0; $i < $maxCount; $i++) {
            $newRow = [];

            foreach ($dataArray as $subArray) {
                if (isset($subArray[$i])) {
                    $newRow[] = $subArray[$i];
                } else {
                    $newRow[] = '';
                }
            }

            $newArray[] = $newRow;
        }
        $adjustedArray = [];

        foreach ($newArray as $subArray) {
            $adjustedSubArray = [];
            foreach ($subArray as $item) {

                if (strpos($item, $this->wordToFind) !== false) {
                    $data = explode($this->wordToFind, $item);
                    if (isset($data[1])) {
                        $adjustedSubArray[] = $data[1];
                        $adjustedSubArray[] = $data[0];
                    } else {
                        $adjustedSubArray[] = '';
                    }
                } else {
                    $adjustedSubArray[] = $item;
                    $adjustedSubArray[] = '';
                }
            }
            $adjustedArray[] = $adjustedSubArray;
        }

        return $adjustedArray;
    }
}
