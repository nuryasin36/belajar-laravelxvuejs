<?php

use Carbon\Carbon;

    function dateFormat($value) {
        return date('d-M-Y', strtotime( $value ));
    }
    function dateFormatWithTime($value) {
        return date('H:i:s - d-M-Y', strtotime( $value ));
    }

    function statusFormat($value) {
        if ($value == true) {
            return "Dikembalikan";
        } else {
            return "Belum dikembalikan";
        };
    }

    function dateDiff($value1, $value2) {

        $value1 = Carbon::createMidnightDate($value1);
        $value2 = Carbon::createMidnightDate($value2);

        $datedifference = $value1->diffInDays($value2);
        // $tahun1 = date('Y', strtotime( $value1 ));
            // if ($tahun1%400 == 0) {
            //     $tahun1 = $tahun1 * 365;
            // } elseif 
        // $tahun2 = date('Y', strtotime( $value2 ));
        // $bulan1 = date('m', strtotime( $value1 ));
        // $bulan2 = date('m', strtotime( $value2 ));
        // $hari1 = date('d', strtotime( $value1 ));

        // $total = $bulan1*30 + $hari1;
        return $datedifference." hari";
    }
?>