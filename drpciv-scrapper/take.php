<?php

require_once __DIR__ . '/connect.inc.php';
require_once __DIR__ . '/MySQL.php';


require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/anticaptcha.php';
require_once __DIR__ . '/recaptchaV2proxyless.php';

use Twilio\Rest\Client;

class Scrapper
{


    private $curl, $infoUrlsMustTaken, $mysqlLink, $MySQL, $infoRegistration;


    public function __construct()
    {

        while (1) {
            $this->curl = curl_init();
            $this->mysqlLink = connectToMySQL();
            $this->MySQL = new MySQL($this->mysqlLink, '');


            file_put_contents(__DIR__ . '/' . "logs.txt", 'cauta data....' . "\n", FILE_APPEND);

            $this->infoUrlsMustTaken = array(

//                4 => array("url" => 'https://drpciv.ro/drpciv-booking-api/getAvailableDaysForSpecificService/4/35', 'category_name' => "Transcriere-vehicul-înmatriculat-in-România"),
                8 => array("url" => 'https://drpciv.ro/drpciv-booking-api/getAvailableDaysForSpecificService/8/35', "category_name" => 'Inmatriculare-vehicul-neînmatriculat-in-România'),
                16 => array("url" => 'https://drpciv.ro/drpciv-booking-api/getAvailableDaysForSpecificService/16/35', "category_name" => 'Autorizare-provizorie-numere roșii')

            );

            foreach ($this->infoUrlsMustTaken as $category => $info) {
                $this->infoRegistration = $this->MySQL->getDetailsRegistration();


                $date = $this->get($info['url']);

                $this->PickUpDate($date[0], $category);
            }


            $this->MySQL->close_mysql();
            curl_close($this->curl);

            sleep(8);
        }


    }


    public function PickUpDate($date, $category)
    {

        preg_match('/(\d+\-\d+\-\d+)/', $date, $match);

        $date = $match[1];
        $this->infoRegistration = $this->MySQL->getDetailsRegistration();


        $this->MakeReservation($date, $category);

    }

    public function get($url)
    {

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0',
                'Accept: application/json',
                'Content-Type: application/json',
                'Referer: https://drpciv.ro/drpciv-booking/activities/35',

            )
        );
        curl_setopt($this->curl, CURLOPT_PROXY, '');
        curl_setopt($this->curl, CURLOPT_PROXYUSERPWD, '');

        $source = curl_exec($this->curl);


        return json_decode($source, true);


    }

    public function post($url, $postFields)
    {

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0',
                'Accept: application/json',
                'Content-Type: application/json',
                'Referer: https://www.drpciv.ro/drpciv-booking/formular/35/vehicleTranscription',
                "Content-Length: " . strlen($postFields),
                "Cookie: acceptedCookie=true"

            )
        );
        curl_setopt($this->curl, CURLOPT_PROXY, '');
        curl_setopt($this->curl, CURLOPT_PROXYUSERPWD, '');
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postFields);
        $source = curl_exec($this->curl);
        file_put_contents(__DIR__ . '/rezervare.txt', date('Y-m-d') . "\n" . $source . "\t" . $postFields . "\n", FILE_APPEND);

        $source = json_decode($source, true);


        return $source;

    }


    private function SendSMS($date)
    {
// Your Account SID and Auth Token from twilio.com/console
        $account_sid = '';
        $auth_token = '';

        $body = " Rezervarea pentru {$this->infoRegistration[0]['nume']} - {$this->infoRegistration[0]['prenume']} a fost facuta in data de {$date} ";


        $twilio_number = "";

        $client = new Client($account_sid, $auth_token);
        $to = array(''); //ADD the number here

        foreach ($to as $number) {
            $client->messages->create(
            // Where to send a text message (your cell phone?)
                "{$number}",
                array(
                    'from' => $twilio_number,
                    'body' => $body
                )
            );
        }


    }

    public function checkHoursAndMinutes($date, $category)
    {

        echo "https://drpciv.ro/drpciv-booking-api/getCalendar?start={$date}&end={$date}&activityCode={$category}&countyCode=35" . "\n";

        $hours = $this->get("https://drpciv.ro/drpciv-booking-api/getCalendar?start={$date}&end={$date}&activityCode={$category}&countyCode=35");
        $dateWithHours = array_keys($hours)[0];


        $bothId = $hours[$dateWithHours][0];
        $dateWithHours = explode(' ', $dateWithHours);

        return array($bothId,$dateWithHours);

    }

    public function MakeReservation($date, $category)
    {




        if ($this->infoRegistration[0]['category'] == $category && $date <= $this->infoRegistration[0]['data']) {
            $hours=$this->checkHoursAndMinutes($date,$category);




            $tokenCaptcha = $this->solveCaptcha("https://drpciv.ro/drpciv-booking/formular/35/vehicleFirstRegistration");

            $postFields = array(
                "firstName" => $this->infoRegistration[0]['prenume'],
                "lastName" => $this->infoRegistration[0]['nume'],
                "fileNumber" => "",
                "email" => "",
                "phone" => "",
                "personalIdentificationNumber" => "",
                "plateNumber" => "",
                "chassisNumber" => $this->infoRegistration[0]['VIN'],
                "countyCode" => 35,
                "activityCode" => $category,
                "startHour" => $hours[1][1],
                "date" => $hours[1][0],
                "boothIds" => array($hours[0]),
                "reCaptchaKey" => $tokenCaptcha

            );

            if(isset($hours[1][1])) {
                $result = $this->post("https://www.drpciv.ro/drpciv-booking-api/reservation/save", json_encode($postFields));

                if (isset($result['success'])) {
                    $this->MySQL->updateDetailsRegistration($this->infoRegistration[0]['id']);
                } else {
                    if (isset($result['errorMessage']['description']) && stripos($result['errorMessage']['description'], 'Datele introduse au fost deja folosite pentru o altă programare!') == true) {

                        $this->MySQL->updateDetailsRegistration($this->infoRegistration[0]['id']);
                    } else if (isset($result['errorMessage']['description']) && stripos($result['errorMessage']['description'], 'Codul de validare nu este corect!') == true) {
                        $tokenCaptcha = $this->solveCaptcha("https://drpciv.ro/drpciv-booking/formular/35/vehicleFirstRegistration");
                        $postFields['reCaptchaKey'] = $tokenCaptcha;
                        $result = $this->post("https://www.drpciv.ro/drpciv-booking-api/reservation/save", json_encode($postFields));

                        if (isset($result['success'])) {
                            $this->MySQL->updateDetailsRegistration($this->infoRegistration[0]['id']);

                        }
                    }


                }
            }

        } else {

            echo "No date to record" . "\n";
            file_put_contents(__DIR__ . '/' . "logs.txt", 'No records reserved....' . "\n", FILE_APPEND);
        }
    }

    public function solveCaptcha($url)
    {

        $api = new RecaptchaV2Proxyless();
        $api->setVerboseMode(true);
        $api->setKey("add the key of recaptcha");
        $api->setWebsiteURL($url);
        $api->setWebsiteKey("token from the recaptcha v3 iframe");

        if (!$api->createTask()) {
            $api->debout("API v2 send failed - " . $api->getErrorMessage(), "red");
            return false;
        }

        //  $taskId = $api->getTaskId();


        if (!$api->waitForResult()) {
            $api->debout("could not solve captcha", "red");
            $api->debout($api->getErrorMessage());
        } else {
            $recaptchaToken = $api->getTaskSolution();
            return $recaptchaToken;
        }
    }
}
$obj=new Scrapper();
