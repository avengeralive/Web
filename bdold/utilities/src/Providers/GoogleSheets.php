<?php

class Providers_GoogleSheets {

    protected static function request($url, $requestQuery) {

    }
    
    public static function registerLead($spreadsheetId, $zakaz) {
        
        $googleAccountKeyFilePath = dirname(__FILE__).'/g-token.json';
        putenv( 'GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath );

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope( 'https://www.googleapis.com/auth/spreadsheets' );
        $service = new Google_Service_Sheets( $client );

        //$response = $service->spreadsheets->get($spreadsheetId);

        //$spreadsheetProperties = $response->getProperties();
        //$spreadsheetProperties->title;

        
        $offer = Offer::getById($zakaz->offer_id);
        
        
        $values = [
                [$zakaz->id, $offer->name, $zakaz->date, $zakaz->name, $zakaz->phone, "", "НОВЫЙ"],
        ];
        $body    = new Google_Service_Sheets_ValueRange( [ 'values' => $values ] );
        $options = array( 'valueInputOption' => 'RAW', 'insertDataOption' => 'INSERT_ROWS' );

        $range = 'Лист1!A2';  // TODO: Update placeholder value.

        $response = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $options);
        
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {       
        return true;
    }
}
