<?php


class GeneralHelper {

	public static function getTitleByReportType($reportType) {
        switch ($reportType) {
            case '1':
                return 'Prihodi ';
            case '2':
               return 'Rashodi ';
            case '3':
                return 'Prihodi i rashodi ';
                   
        }
    }

    public static function getMessageForEmptyResult($reportType) {
    	switch ($reportType) {
            case '1':
                return 'Ne postoje prihodi za traženi period.';
                break;
            case '2':
                return 'Ne postoje rashodi za traženi period.';
            case '3':
                return 'Ne postoje prihodi i rashodi za traženi period.';
            default:
                return null;
        }
    }
}