<?PHP

//Capture IP
$ip =  $_SERVER["REMOTE_ADDR"];
//Capture page name
$pageName = basename($_SERVER['PHP_SELF']);
//Print IP to screen
echo "Your IP is $ipaddress!".$ip."<br/>";
//Test for email construction
$from = "Page on site - ".$pageName;
$subject = "Ip Lookup";
$message = $ip ;
echo $from,"<br/>", $subject,"<br/>", $message ,"<br/>";

//mail the message mail("tsuttle@fuzionitsolutions.com",$subject,$message,"From:". $from);
	echo "Thank you for your information ,<br/>";


       //$ip='94.219.40.96';
       //print_r(geoCheckIP($ip));
	   echo "<br/>";
       //Array ( [domain] => dslb-094-219-040-096.pools.arcor-ip.net [country] => DE - Germany [state] => Hessen [town] => Erzhausen )

       //Get an array with geoip-infodata
       function geoCheckIP($ip)
       {
               //check, if the provided ip is valid
               if(!filter_var($ip, FILTER_VALIDATE_IP))
               {
                       throw new InvalidArgumentException("IP is not valid");
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               //$patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';
				
               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
					  
               }

               return $ipInfo;
       }
			
			//Set the function as a variable
			$NeedPrint = geoCheckIP($ip);
			// echo to screen each value in array
			echo $NeedPrint['country']. "<br/>" . $NeedPrint['state']. "<br/>" .$NeedPrint['town']. "<br/>";
			
			//print_r(geoCheckIP($ip));
			
	

?>