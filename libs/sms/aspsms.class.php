<?php
/**
 * @author nadar <basil.suter@indielab.ch>
 * @see https://github.com/nadar/aspsms-php-class
 * 
 * $id$
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// see if the curl extension is loaded
if (!function_exists('curl_init')) {
    throw new AspsmsException('Aspsms needs the CURL PHP extension, curl_init() function not found!');
}

/**
 * Version information:
 * 
 * 1.1:
 *  - added version constant
 *  - added static public function to verify the tracking number validity
 */

/**
 * The Aspsms class provides the basic function to easily send message, check delivery status or 
 * show the available amount of credits.
 * 
 * Basic usage example:
 * 
 * // init aspsms class with originator option
 * $aspsms = new Aspsms('<YOUR_KEY>', '<YOUR_PASSWORD>', array(
 *     'Originator' => '<MY_SENDER_NAME>'
 * ));
 * 
 * // set the message and recipients with tracking numbers.
 * $send = $aspsms->sendTextSms('<YOUR_SMS_MESSAGE>', array(
 *     '<TRACKING_NR1>' => '<MOBILE_PHONE_NR1>',
 *     '<TRACKING_NR2>' => '<MOBILE_PHONE_NR2>',
 *     '<TRACKING_NR3>' => '<MOBILE_PHONE_NR3>'
 * ));
 * 
 * // check for sending errors
 * if (!$send) {
 *     echo "Aspsms Error: " . $send->getSendStatus();
 * }
 * 
 * // script needs to sleep 10 seconds, because the delivery takes some time
 * sleep(10);
 * 
 * // check status after 10 seconds
 * $status1 = $aspsms->deliveryStatus(<TRACKING_NR1>);
 * $status2 = $aspsms->deliveryStatus(<TRACKING_NR2>);
 * $status3 = $aspsms->deliveryStatus(<TRACKING_NR3>);
 * 
 * var_dump($status1, $status2, $status3);
 * 
 * @package Aspsms
 * @author nadar <basil.suter@indielab.ch>
 * @see https://github.com/nadar/aspsms-php-class
 */
class Aspsms
{
    const VERSION = 1.1;
    
    /**
     * Contains the services url [status 30.01.2013]
     * 
     * @var string
     */
    public $server = "https://webservice.aspsms.com/aspsmsx2.asmx/";
    
    /**
     * Contains the userkey which is provided from the aspsms.com webpage under the menu 
     * point "USERKEY". Lookes somehwat like that FAG9XPAUQLQ3
     * 
     * @var string
     */
    private $userkey = null;
    
    /**
     * The password you use to login on the webpage (aspsms.com), in its blank not encrypted form...
     * 
     * @var string
     */
    private $password = null;
    
    /**
     * All sms status service reason codes which appears to be used when u have a not usual 
     * deliver status. There is an optional newsletter from 2009 with some more informations [see]
     * 
     * @see http://www.aspsms.de/newsletter/html/en/200905/
     * @var array
     */
    private $deliveryReasonCodes = array(
        "000" => "Unknown Subscriber",
        "001" => "Service temporary not available",
        "009" => "Illegal error code",
        "010" => "Network time-out",
        "100" => "Facility not supported",
        "101" => "Unknown subscriber",
        "102" => "Facility not provided",
        "103" => "Call barred",
        "104" => "Operation barred",
        "105" => "SC congestion",
        "106" => "Facility not supported",
        "107" => "Absent subscriber",
        "108" => "Delivery fail",
        "109" => "SC congestion",
        "110" => "Protocol error",
        "111" => "MS not equipped",
        "112" => "Unknown SC",
        "113" => "SC congestion",
        "114" => "Illegal MS",
        "115" => "MS not a subscriber",
        "116" => "Error in MS",
        "117" => "SMS lower layer not provisioned",
        "118" => "System fail",
        "119" => "PLMN system failure",
        "120" => "HLR system failure",
        "121" => "VLR system failure",
        "122" => "Previous VLR system failure",
        "123" => "Controlling MSC system failure",
        "124" => "VMSC system failure",
        "125" => "EIR system failure",
        "126" => "System failure",
        "127" => "Unexpected data value",
        "200" => "Error in address service centre",
        "201" => "Invalid absolute Validity Period",
        "202" => "Short message exceeds maximum",
        "203" => "Unable to Unpack GSM message",
        "204" => "Unable to convert to IA5 ALPHABET",
        "205" => "Invalid validity period format",
        "206" => "Invalid destination address",
        "207" => "Duplicate message submit",
        "208" => "Invalid message type indicator"
    );
    
    /**
     * Contains all delivey sms notification status
     * 
     * @var array
     */
    private $deliveryStatusCodes = array(
       -1 => "Not yet submitted or rejected",
        0 => "Delivered",
        1 => "Buffered",
        2 => "Not Delivered"
    );
    
    /**
     * Response status codes when you send an sms
     * 
     * @var array
     */
    private $sendStatusCodes = array(
        1 => "Ok",
        3 => "Authorization failed",
        5 => "Not enough Credits available"
    );
    
    /**
     * Contains the sms status response value from $sendStatusCodes
     * 
     * @var string
     */
    private $sendStatus = null;
    
    /**
     * Contains all valid option parameters which can be delivere trough option
     * arguments in functions.
     * 
     * @var array
     */
    private $validOptions = array(
        "Originator",
        "DeferredDeliveryTime",
        "FlashingSMS",
        "TimeZone",
        "URLBufferedMessageNotification",
        "URLDeliveryNotification",
        "URLNonDeliveryNotification",
        "AffiliateId", 
        "MessageText",
        "Recipients",
        "TransactionReferenceNumbers"
    );
    
    /**
     * All active options with their values, will be flushed after each request
     * 
     * @var string
     */
    private $currentOptions = array();
    
    /**
     * Class construct contains basic informations which are needed for each request type.
     * 
     * @param string    $userkey            The userkey provided from aspsms.net
     * @param string    $password           The blank passwort from your aspsms.net login
     * @param array     $options[optional]  Basic associativ array, available keys see $validOptions array. Commonly used 
     *                                      to provide AffiliateId or Originator.
     * @return void
     */
    public function __construct ($userkey, $password, array $options = array()) {
        // save userkey
        $this->userkey = $userkey;
        // save password
        $this->password = $password;
        // set optional options if any provided
        $this->setOptions($options);
    }
    
    /**
     * Main function sendTextSms, used to send a SMS message to multiple recipients.
     * 
     * Usage example without options:
     * sendTextSms("Hello world! I am your message", array(
     *     "0001" => "0041123456789",
     *     "0002" => "0041123456780"
     * ));
     * 
     * Usage example with options:
     * sendTextSms("Hello world! I am your message", array(
     *     "0001" => "0041123456789",
     *     "0002" => "0041123456780" 
     * ), array(
     *     "Originator" => "MYCOMPANY_SENDER_NAME",
     *     "AffiliateId" => "1234567"
     * ));
     * 
     * @param string    $message            Contains the message text for the user. can only be 160 chars
     * @param array     $recipients         Array containing the recipients, where the key is the tracking number and the value
     *                                      equats the mobile number. Mobile Number format must be without spaces or +(plus) signs.
     * @param array     $options[optional]  Basic associativ array, available keys see $validOptions array. Commonly used to provide
     *                                      AffiliateId or Originator values.
     * @return boolean
     * @throws AspsmsException
     */
    public function sendTextSms ($message, array $recipients, array $options = array()) {
        // set message option
        $this->setOption("MessageText", $message);
        // set recipients option
        $recipientList = array(); 
        // collect all recipients with teir
        foreach ($recipients as $tracknr => $number) {
            // according to the docs multiple recipients must look like this: <NUMBER>:<TRACKNR>;<NUMBER>:<TRACKNR>
            $recipientList[] = "$number:$tracknr";
        }
        // se the recipients into the options list
        $this->setOption("Recipients", implode(";", $recipientList));
        // optional options parameter to set values into currentOptions
        $this->setOptions($options);
        // start request width defined options for this action
        $response = $this->request("SendTextSMS", $this->getOptions(array(
            "Recipients",
            "AffiliateId",
            "MessageText",
            "Originator",
            "DeferredDeliveryTime",
            "FlashingSMS",
            "TimeZone",
            "URLBufferedMessageNotification",
            "URLDeliveryNotification",
            "URLNonDeliveryNotification"
        )));
        // explode the response
        $result = explode(":", $response);
        // error while exploding the response
        if (count($result) == 0 || !is_array($result)) {
            throw new AspsmsException("Something went wrong while working with the sendTextSms response. Response: \"{$response}\"");
        }
        // verify if the status code exists in sendStatusCodes
        if (!array_key_exists($result[1], $this->sendStatusCodes)) {
            throw new AspsmsException("Error while printing the response code into sendStatus. ResponseCode seems not valid. Response: \"{$response}\"");
        }
        // send the status as text value into $sendStatus
        $this->sendStatus = $this->sendStatusCodes[$result[1]];
        // if the result is not equal 1 something is wrong
        if ($result[1] !== "1") {
            return false;
        }
        // response true
        return true;
    }
    
    /**
     * Getting all informations from sms delivery system for the provided tracking number (which you put besides the recipients)
     * 
     * Accoring to the Documentation on aspsms.net a response as partial seperated by semicolon (;) below the descriptions of the parts:
     * => TransactionReferenceNumber ; DeliveryStatus ; SubmissionDate ; NotificationDate ; Reasoncode
     * Below some sample responses from the "InquireDeliveryNotifications" method:
     * => success-delivery: 1359553540;0;30012013144546;30012013144555;000;;
     * => failure-delivery: 1359555046;2;30012013151053;30012013151053;206;;
     * 
     * @param mixed   $tracknr    The tracking number which is provided when setting the recipients. Can be an array of tracking numbers.
     * @return array (If an array with multiple tracking numbers is provided the response as an assoc array for each tracking number.)
     * @throws AspsmsException
     */
    public function deliveryStatus ($tracknr) {
        // set the transaction reference numbers
        $this->setOption("TransactionReferenceNumbers", implode(";", (array) $tracknr));
        // start request
        $response = $this->request("InquireDeliveryNotifications", $this->getOptions(array(
            "TransactionReferenceNumbers"
        )));
        // response array
        $responseArray = array();
        // count the response array
        $i = 0;
        // foreach multiple response codes
        foreach (explode(";;", $response) as $trackResponse) {
            // verify empty strings
            if (strlen($trackResponse) == 0 || empty($trackResponse)) {
                // skip this entrie
                continue;
            }
            // explode the response
            $result = explode(";", $trackResponse);
            // error while exploding the response
            if (count($result) == 0 || !is_array($result)) {
                throw new AspsmsException("Something went wrong while working with the deliveryStatus response. Response: \"{$response}\"");
            }
            // set default value for reasoncode
            if ($result[1] == 0) {
                // no error, but reasocode seems to 000 anytime when success... which is wrong!
                $reasoncode = "-";
            } else {
                // set string for reasoncode
                $reasoncode = (isset($result[4]) && isset($this->deliveryReasonCodes[$result[4]])) ? $this->deliveryReasonCodes[$result[4]] : null;
            }
            // add assoc array
            $responseArray[$result[0]] = array(
                "transactionReferenceNumber" => $result[0],
                "deliveryStatus" => $this->deliveryStatusCodes[$result[1]],
                "submissionDate" => $this->dateSplitter($result[2]),
                "notificationDate" => $this->dateSplitter($result[3]),
                "reasoncode" => $reasoncode
            );
            // add i+1
            $i++;
        }
        // see if we have an error with the response
        if ($i === 0) {
            throw new AspsmsException("Error while explode multiple response elements. Response: \"{$response}\"");
        }
        // if there is only 1 result, we have to return only the single assoc array
        if ($i === 1) {
            // return the first element (there is only one)
            foreach ($responseArray as $item) {
                return $item;
            }
        }
        // multiple tracking codes enterd, return the whole array
        return $responseArray;
    }
    
    /**
     * Get the amount of left credits connected to your account.
     * 
     * @return integer
     * @throws AspsmsException
     */
    public function credits () {
        // make request for "CheckCredits" aspsms method
        $response = $this->request("CheckCredits");
        // explode the response
        $result = explode(":", $response);
        // error while exploding the response
        if (count($result) == 0 || !is_array($result)) {
            throw new AspsmsException("Something went wrong while working with the credits response. Response: \"{$response}\"");
        }
        // return the amount
        return (int)$result[1];
    }
    
    /**
     * Provides the possibility to read the sendstatus as a readable-response-string (from $sendStatusCodes array)
     * 
     * @return string
     */
    public function getSendStatus () {
        return $this->sendStatus;
    }
    
    /**
     * Will delete all not allowed signes to store restore tracking number in database or on Aspsms site
     * 
     * @param string    $trackingNumber The tracking number to verify
     * @return string
     */
    public static function verifyTrackingNumber ($trackingNumber) {
        // only a-z A-Z and 0-9 are allowed signs for tracking numbers, preg replace and return.
        return preg_replace("/[^a-zA-Z0-9]/", "", $trackingNumber);
    }
    
    /**
     * Execute the CURL HTTP POST request to aspsms server. Below a description of the different actions and their values/options:
     * 
     * @see https://webservice.aspsms.com/aspsmsx2.asmx
     * @param string    $action     Contains the aspsms service defined action name like: CheckCredits, InquireDeliveryNotifications, SendTextSMS
     * @param array     $values     The values which needs to be passed to this action
     * @return string/mixed
     */
    private function request ($action, array $values = array()) {
        // build new AspsmsRequest-Object
        $request = new AspsmsRequest($this->server . $action, $this->prepareValues($values));
        // transfer the request
        $response = $request->transfer();
        // flush request class
        $request->flush();
        // flush local settings
        $this->flush();
        // return request response to its executed method
        return $response;
    }
    
    /**
     * We put all options together, and also add the always the basics like userkey and password.
     * 
     * @param array     $values     The key is the "post-field" and the value the "post-field-associated-value"
     * @return array
     */
    private function prepareValues ($values) {
        // set default transfer values
        $transferValues = array(
            'UserKey' => $this->userkey,
            'Password' => $this->password
        );
        /// get the request values urlencode und utf8encode first.
        foreach ($values as $key => $value) {
            $transferValues[$key] = $value;
        }
        // return changed transfer values
        return $transferValues;
    }
    
    /**
     * After a request like smssend, deliverystatus or creditscheck we set back the default
     * options value for furter requests. which is an emptyarray
     * 
     * @return void
     */
    private function flush () {
        // set back the default empty array
        $this->currentOptions = array();
        // set back send status buffer string
        $this->sendStatus = null;
    }
    
    /**
     * Set transfer options/values into currentOptions. Only options which are in the list $validOptions
     * are allowed to set.
     * 
     * @param string    $key    The Option-Key/Name
     * @param string    $value  The value for the Option-Key
     * @return boolean
     * @throws AspsmsException
     */
    private function setOption ($key, $value) {
        // see if key is in the validOptions list.
        if (!in_array($key, $this->validOptions)) {
            throw new AspsmsException("setOption: Could not find the option \"$key\" in the validOptions list!");
        }
        // set the options into the currentOptions list
        $this->currentOptions[$key] = $value;
        // default return
        return true;
    }
    
    /**
     * Set multiple transfer options into currentOptions. Only options which are in the list
     * $validOptions are allowed to set.
     * 
     * @param array     $options    An associativ array containg the the option-keys and option-key-values
     * @return boolean
     * @throws AspsmsException
     */
    private function setOptions (array $options) {
        // loop the $options items
        foreach ($options as $key => $value) {
            // see if the key exists int options list
            if (!in_array($key, $this->validOptions)) {
                throw new AspsmsException("setOptions: Could not find the option \"$key\" in the validOptions list!");
            }
            // set the options into the currentOptions list
            $this->currentOptions[$key] = $value;
        }
        // default return
        return true;
    }
    
    /**
     * Gets all options/values. If there is no value set for the needed $optionKeys the function sets
     * an empty default string '' and returns all requests $optionKeys
     * 
     * @param array     $optionKeys     All options which are requested
     * @return array
     */
    private function getOptions (array $optionKeys) {
        // return options array
        $options = array();
        // foreach all option keys and see if some values are set in the currentOptions array
        foreach ($optionKeys as $key) {
            // see if this option is set in options list
            if (array_key_exists($key, $this->currentOptions)) {
                $options[$key] = $this->currentOptions[$key];
            } else {
                $options[$key] = '';
            }
        }
        // return all options
        return $options;
    }
    
    /**
     * The delivery status return timestamp seems not to be very readable, so we have to split
     * the input string by "hand"
     * 
     * @param string    $date   Input date string like: 30012013223015
     * @return string
     */
    private function dateSplitter ($date) {
        // get the date pieces
        $d = substr($date, 0, 2);
        $m = substr($date, 2, 2);
        $y = substr($date, 4, 4);
        $h = substr($date, 8, 2);
        $i = substr($date, 10, 2);
        $s = substr($date, 12, 2);
        // but the together and return
        return "{$d}.{$m}.{$y} {$h}:{$i}:{$s}";
    }
}

/**
 * Little Helper class to make the curl-post-request to the aspsms server.
 * 
 * Usage example:
 * 
 * $request = new AspsmsRequest('https://webservice.aspsms.com/aspsmsx2.asmx/CheckCredits');
 * // transfer the request
 * $response = $request->transfer();
 * // flush the request object
 * $request->flush();
 * 
 * @package Aspsms
 * @author nadar <basil.suter@indielab.ch>
 * @see https://github.com/nadar/aspsms-php-class
 */
class AspsmsRequest
{
    /**
     * Default options for the curl request
     * 
     * @param array
     */
    private $options = array(
        CURLOPT_TIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true
    );
    
    /**
     * All values which are provided trought value() or __construct()
     * 
     * @param array
     */
    private $values = array();
    
    /**
     * AspsmsRequest constructor requerd call service url.
     * 
     * @param string    $url                The called webservice url
     * @param array     $values[optional]   Values can be set direct in the class construct or 
     *                                      via the value() method.
     */
    public function __construct ($url, array $values = array()) {
        // assign CURLOPT_URL into options array
        $this->options[CURLOPT_URL] = $url;
        // set basic value keys into values array
        $this->values = $values;
    }
    
    /**
     * Optional method to set values.
     * 
     * @param string    $key    The POST-FIELD-KEY
     * @param string    $value  The value of the postfield
     * @return boolean
     */
    public function value($key, $value) {
        // save values into values array (great comment)
        $this->values[$key] = $value;
        // default return
        return true;
    }
    
    /**
     * Unset all values from the values array to make new requests.
     * 
     * @return boolean
     */
    public function flush () {
        // overwrite $values with empty array()
        $this->values = array();
        // default return
        return true;
    }
    
    /**
     * Could not use http_build_query() because of &, ; & : signs changing, need to build a 
     * simple small class to build the strings.
     * @todo url_encoding the values (verify affecting requests first)
     * @param array     $values     Key value pared parameter values
     * @return string 
     */
    private function buildPostfields ($values) {
        $params = array();
        foreach ($values as $k => $v) {
            $params[] = $k.'='.$v;
        }
        return implode("&", $params);
    }
    
    /**
     * Init the main curl excution.
     * 
     * @return string/mixed
     * @throws AspsmsException
     */
    public function transfer () {
        // prepare postfields
        $this->options[CURLOPT_POSTFIELDS] = $this->buildPostfields($this->values);
        // init curl
        $curl = curl_init();
        // set all options into curl object from $options
        curl_setopt_array($curl, $this->options);
        // excute the curl and write response into $response
        $response = curl_exec($curl);
        // close the curl connection
        curl_close($curl);
        // see if response is xml valid (else we have a basic api error)
        if (preg_match('/\<\?xml(.*)\?\>/', $response)) {
            // get node content
            $doc = new DOMDocument();
            // load the xml reponse (which is xml)
            $doc->loadXML($response);
            // get content from the firstChild (there is no good documentation about aspsms response bodys)
            $nodeContent = $doc->firstChild->textContent;
            // return the content
            return $nodeContent;
        } else {
            throw new AspsmsException("API response seems not valid! Response: \"" . trim($response) . "\"");
        } 
    }
}

/**
 * AspsmsEception class
 *
 * @package Aspsms
 * @author nadar <basil.suter@indielab.ch>
 * @see https://github.com/nadar/aspsms-php-class
 */
class AspsmsException extends Exception
{}