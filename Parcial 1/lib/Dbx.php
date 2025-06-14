<?php
define("DATA_DIR", __DIR__ . "/datax/");


if (!is_dir(DATA_DIR)){
    mkdir(DATA_DIR, 0777, true);
}

class Dbx{

    public static function list($collection){
        $datapath = DATA_DIR . "/{$collection}";

        if(!is_dir($datapath)){
            return [];
        }

        $files = scandir($datapath);
        $data = [];

        foreach($files as $file){
            $filepath = $datapath . "/" . $file;

            if(!is_file($filepath)){
                continue;
            }
            $content = file_get_contents($filepath);
            $itemData = unserialize($content);

            if($itemData){
                $data[] = $itemData;
            }
        }
        return $data;
    }

    public static function get($collection, $id){
        $datapath = DATA_DIR . "/{$collection}";

        if (!is_dir($datapath)){
        mkdir($datapath, 0777, true);
        }
        
        $content = file_get_contents($datapath);
        return unserialize($content);

    }

    public static function save($collection, $item){
        $datapath = DATA_DIR . "/{$collection}";

        if (!is_dir($datapath)){
        mkdir($datapath, 0777, true);
        }
        
        $filename = (strlen($item->idx) > 4) ? $item->idx : uniqid();
        $item->idx = $filename;
        $filepath = $datapath . "/" . $filename . ".dat";
        
        file_put_contents($filepath, serialize($item));

    }

    public static function delete($collection, $id){
        $datapath = DATA_DIR . "/{$collection}/{$id}.dat";
        
        if(file_exists($datapath)){
            unlink($datapath);
            return true;
        }
        return false;
    }



}

?>