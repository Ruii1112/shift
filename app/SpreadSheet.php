<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpreadSheet extends Model
{
    public static function instance() {

        #$credentials_path = storage_path('app/json/credentials.json');
        $credentials_path = [
            "type" => "service_account",
            "project_id" => "devtest-356611",
            "private_key_id" => "cac8048ea9f8def93ffb8f55480f1cc02b683d50",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDMmfkWBwBzePAZ\nmUFganFkWE18yjqHov2H8zL2rdIibvMDlH7gcM47a3HxH/fH8QWeLomLp28HHMQk\nIs7BY+78CwVZH3FDnEIrE/mm2/8JSVbAYAZoTjaP+zL5AR5B8cE2aZF3BnFE337C\nVL20MSYxL1l5/13rehOUYUqH9Zs/+n5i31vRr3lrjZAqB8N90+wlMUssThDpeFOj\njW514S7VrJlfRf5TOTte6uAy5yGp0Pg6m1Njk9SQIrBrOlAsGX0ohQiX47G04ubW\njfuKljO8xxl4nK81NRn9d7oYnLtB53Iv/CuuJnyv6iThfYjYLDt15PlQqlwO9CAK\n16y8HrkpAgMBAAECggEAKWdaRPcfQ/7cBa4iEP8RWcdVzPRGomadLDsOm+VCgiXW\nJyoQf95MGbGtUeiQdaVkZ+WOf5SfLv8HATILCY8t0FLxnt6yRsaTDFEjQv0/j9NH\nyy/TdB2pxHrGzqWHiDxCR37XCVFkMBYTOoO4DQQqMKdekcXX7XxbhHoowTk2VNyB\nB2Ql7MD8xUDAnF1S31SLYnshO0p3K2abbGMHLro31puy6rafFrJKXx2bVvLodIyf\nEgxdP6n86bsD3tpiCg/gbAO/buHrymfFxr9h2TkHxh57DozeoEHK9tfpwTpMAaxb\nbbOjG/LKPaUIPb66csRE3rNK4i1lUMnQyIRf/lBQRQKBgQD1WW/1c5n1TnVM1lQI\nfSK61V8+5HiKTu5yctHNpqGu1BP8PfTnWs23HFMa2ej7aAvCug9ZOoVl7qLhect2\ne7v1GPzM3YSUMpmkJGzhVaLMieaMZNZruefoh3Hkvzy+zCZiXjKJ3flCULjCy4Vc\nPUhT6nYjx3Fk17HkFkgLL4uEXQKBgQDVe7R4H43Q70E3fLjWGxhmsE0NOSBUhSBW\n7bbTQfKmKC6T3c8VaQ4Gycf8T8QaRUgw/xfUp37ZzlibZuzHn1n5qQ80gFrJv0+k\nNraNpBqmnFkgzUMqHEAxeQ5DFVwywndvB6pk25dqG/SiX6YzYWWs38JnifrG1F4N\nmkTGL+37PQKBgCJyEQ7j0PyorD1CZf/fGa4jYMDisK2yUTXOOvhlaZOzAK9MP4Lv\ns6v+lQhTCauqOuR23MrJNYtPCp0fTVpwGr5ZaLyWaROpWvq5hnPIYxfWUIDrc1Mi\ngZWa1nmoA65B2S28TdofSOxvitEGY83EaNAnPbjeOmRPCBGeszSm0y6dAoGBAL08\n8RbicaXZ0CfNiVNRpWmxsjucfgouECK+iafu95dOWyt8HYtPGr3ttDb2xlC7RWkZ\nVxiMeSe9gFIRBKdXnDxxHidd+ByKV6CrV1trMqyqP1+SVI1JiaXRN1FD5/ye4Zws\nYWESPsAyk8Izo3I8ThLWLs/1QbVqnwzTyU8dQYnJAoGAINLHRJbFlSkmOv9koFQc\nH4rnMg/pL344Pk265iwUS0MYnKlnMMgyMIV7/nULzhnTcTsy8qpvsJWDQwqacADm\nYB2Qcozn5GvLThjIOFS8wYrpgz6bLnvYgTf6ecBFN6ATzPpn979rwibybaZ7Ibov\nTGCkmV0YDBX++Wz/6bBipUc=\n-----END PRIVATE KEY-----\n",
            "client_email" => "shift-762@devtest-356611.iam.gserviceaccount.com",
            "client_id" => "104190876339908067874",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/shift-762%40devtest-356611.iam.gserviceaccount.com"
        ];
        $client = new \Google_Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);

    }
}
