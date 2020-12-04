<?php

namespace App\Sms;


class SendSMS 
{
  
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public static function handle()
    {
        $endpoint = "http://smsnanan.groupe-creativ.com/api.php";
        $keyword = 'ANEREE';
        $api_key = 'df066849-688b-426f-84a5-eb47a3f664ce';
        $params=[
                    'keyword'   => $keyword,
                    'api_key'   => $api_key,
                    'message'   => $this->details['message'],
                    'to'        => $this->details['to'],
                ];

        /* make a POST request using curl */
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
             http_build_query($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
    }
}
