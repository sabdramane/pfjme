<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
	protected $details;
    
	 /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message,$to)
    {
        $this->endpoint = "http://smsnanan.groupe-creativ.com/api.php";
        $this->keyword = 'ANEREE';
        $this->api_key = 'df066849-688b-426f-84a5-eb47a3f664ce';
        $this->params=[
        			'keyword'	=> $this->keyword,
					'api_key'	=> $this->api_key,
					'message'	=> $message,
					'to'		=> $to,
        		];
    }

  
  /**
     * Execute the envoi.
     *
     * @return void
     */
    public function handle()
    {
        /* make a POST request using curl */
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $this->endpoint);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, 
	         http_build_query($this->params));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    $server_output = curl_exec($ch);

        curl_close ($ch);
    }
	    
}
