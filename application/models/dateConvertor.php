<?php
class App_Model_dateConvertor  {

    public function mysqlformat($nformat) {
        $ndate = new Zend_Date($nformat, 'dd/mm/yyyy');
        $mdate = $ndate->toString('yyyy-mm-dd');
        return $mdate;
     }

    public function normalformat($mformat) {
        $mdate = new Zend_Date($mformat, 'yyyy-mm-dd');
        $ndate = $mdate->toString('dd/mm/yyyy');
        return $ndate;
    }


    public function phpmysqlformat($nformat){
        $ndate=explode("/",$nformat);
        $mdate=$ndate[2]."-".$ndate[1]."-".$ndate[0];
        return $mdate;
    }

    public function phpnormalformat($mformat){
        $mdate=explode("-",$mformat);
        $ndate=$mdate[2]."/".$mdate[1]."/".$mdate[0];
        return $ndate;
    }


    public function dateDiff($start, $end) {
            $start_ts = strtotime($start);
            $end_ts = strtotime($end);
            $diff = $end_ts - $start_ts;
            return round($diff / 86400);
    }

    public function position($amt,$posValue) {
            $len=strlen($amt);
            $pos=($posValue-35)-($len*4);
            return $pos;
    }
}

